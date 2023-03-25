<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
