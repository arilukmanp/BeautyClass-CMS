<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'merchant_id', 'no_nota', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cashback()
    {
        return $this->hasOne('App\Models\Cashback');
    }
}
