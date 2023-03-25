<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'type',
        'amount',
        'end_date'
    ];

    public function getAmount()
    {
        if($this->isFixed()) return $this->amount;

        return (int)$this->amount;
    }

    public function isFixed() { return $this->type == 'price'; }
}
