<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'merchant_id', 'name', 'description', 'expire', 'min_purchase', 'cashback', 'max_cashback', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cashback()
    {
        return $this->hasMany('App\Models\Cashback');
    }
}
