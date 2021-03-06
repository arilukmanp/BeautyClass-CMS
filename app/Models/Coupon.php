<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id', 'no_coupon'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
