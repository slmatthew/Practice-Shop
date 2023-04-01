<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orders_items';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];

    public function isPriceActual()
    {
        return (float)$this->price == (float)Product::find($this->product_id)->getPrice();
    }

    public function hasDiscountedPrice()
    {
        $product = Product::find($this->product_id);
        return (float)$this->price != (float)$product->price && $product->available;
    }

    public function getDiscountPercent()
    {
        if(!$this->hasDiscountedPrice()) return 0;

        $product = Product::find($this->product_id);
        return 100 - (int)($this->price / $product->price * 100);
    }
}
