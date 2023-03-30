<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'updated_at',
        'category_id',
        'hidden',
        'available'
    ];

    public $sortable = [
        'name',
        'price',
        'created_at'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    /**
     * Позлащает актуальную цену товара
     * Если есть скидка - возвращает скидочную цену
     * Если нет - обычную
     *
     * @return bool|float|int|mixed
     */
    public function getPrice() {
        return $this->getDiscount();
    }

    /**
     * Проверяет, есть ли скидка на товар
     *
     * @return float
     */
    public function hasDiscount() {
        return $this->getDiscount(false);
    }

    /**
     * Проверяет, доступен ли товар к покупке и есть ли на него скидка
     *
     * @return bool
     */
    public function hasDiscountAndAvailable() {
        return $this->available && $this->getDiscount(false);
    }

    public static function formatPrice($price, bool $needRuble = true) {
        return number_format($price, 2, ',', ' ') . ($needRuble ? ' ₽' : '');
    }

    /**
     * Форматирует цену товара
     *
     * @param bool $realPrice Использовать первоначальную стоимость?
     * @param bool $needRuble Добавить знак ₽ в конец строки?
     * @return string
     */
    public function getFormattedPrice(bool $realPrice = false, bool $needRuble = true) {
        $price = $realPrice ? $this->price : $this->getPrice();

        return $this->formatPrice($price, $needRuble);
    }

    /**
     * Возвращает значение скидки в процентах
     *
     * @return int
     */
    public function getDiscountPercent(?Discount $discount = null) {
        if(!$this->hasDiscount() && is_null($discount)) return 0;

        $discount = $discount ?? $this->getActualDiscount();
        if(!is_null($discount) && !$discount->isFixed()) return $discount->getAmount();

        $price = $this->price;
        $discounted = $discount->getAmount();

        $diff = $price - $discounted;
        $percent = (int)($discounted / $price * 100);

        return 100 - $percent;
    }

    /**
     * Возвращает модель Discount при наличии актуальной скидки или null
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder|object|null
     */
    private function getActualDiscount() {
        $discount = $this->discounts()->latest()->limit(1)->first();
        if(!is_null($discount)) {
            if(is_null($discount->end_date) || Carbon::parse($discount->end_date, 'Europe/Moscow')->gt(Carbon::now('Europe/Moscow'))) {
                return $discount;
            }
        }

        return null;
    }

    /**
     * Возвращает актуальную цену товара
     * Если есть скидка, то в зависимости от вида скидки возвращает:
     * - указанную фиксированную цену
     * - вычисленную скидку (отнимается процент от цены товара)
     *
     * Если скидки нет, возвращает обычную цену товара
     *
     * Может работать в режиме проверки
     *
     * @param bool $needPrice Если true, то вернет цену, иначе - проверит на наличие скидки
     * @return bool|float|int|mixed
     */
    private function getDiscount(bool $needPrice = true) {
        $discount = $this->getActualDiscount();
        if(!is_null($discount)) {
            return $needPrice ? $this->getDiscountedPrice($discount) : true;
        }

        return $needPrice ? $this->price : false;
    }

    public function getDiscountedPrice(Discount $discount) {
        if($discount->product_id != $this->id) return null;

        if($discount->type == 'price') {
            return $discount->getAmount();
        } else {
            return $this->price - ($this->price * $discount->getAmount() / 100);
        }
    }

    /**
     * Возвращает самый дешевый товар в категории с учетом скидок
     *
     * @param ?Category $category
     * @param ?Brand $brand
     * @return Product|null
     */
    public static function getCheapestInGroup(?Category $category = null, ?Brand $brand = null)
    {
        $request = DB::table('products')
            ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
            ->where('hidden', 0);

        $request = $category ? $request->where('products.category_id', $category->id) : $request;
        $request = $brand ? $request->where('products.brand_id', $brand->id) : $request;

        $request = $request
            ->where(function ($query) {
                $query->where('discounts.end_date', '>', Carbon::now('Europe/Moscow'))
                    ->orWhereNull('discounts.end_date');
            })
            ->selectRaw('products.*, COALESCE(
                    MIN(
                        CASE
                            WHEN discounts.type = "price" THEN discounts.amount
                            WHEN discounts.type = "percent" THEN products.price * ((100 - discounts.amount) / 100)
                            ELSE products.price
                        END
                    ),
                    products.price
                ) AS min_price')
            ->groupBy('products.id')
            ->orderBy('min_price');

        if(!$request->get()->count()) return null;

        $product = $request->first();
        $product->min_price = bcdiv($product->min_price, 1, 2);

        return $product;
    }
}
