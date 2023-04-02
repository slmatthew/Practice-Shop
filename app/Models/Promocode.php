<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'promocode',
        'activation_limit',
        'discount',
        'expires_at'
    ];

    public function usersPromocodes()
    {
        return $this->hasMany(UserPromocode::class);
    }

    public function getLimitExceededAttribute()
    {
        return $this->activation_limit != 0 && $this->usersPromocodes->count() >= $this->activation_limit;
    }

    public function getExpiredAttribute()
    {
        return !!$this->expires_at && \Carbon\Carbon::now('Europe/Moscow') > \Carbon\Carbon::parse($this->expires_at, 'Europe/Moscow');
    }

    public function getAvailableAttribute()
    {
        return !$this->limit_exceeded && !$this->expired;
    }
}
