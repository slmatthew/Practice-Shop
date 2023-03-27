<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
