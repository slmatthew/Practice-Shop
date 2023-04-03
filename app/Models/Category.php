<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $image_url
 * @property string|null $slug
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $cheapest_product
 * @property-read mixed $min_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'image_url'
    ];
    
    public function getCheapestProductAttribute()
    {
        return Product::getCheapestInGroup($this);
    }

    public function getMinPriceAttribute()
    {
        $cheapest = $this->cheapest_product;

        return is_null($cheapest) ? 0 : $cheapest->min_price;
    }
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
