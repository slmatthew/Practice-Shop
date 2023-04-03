<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPromocode extends Model
{
    use HasFactory;

    protected $table = 'users_promocodes';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'promocode_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promocode()
    {
        return $this->belongsTo(Promocode::class);
    }
}
