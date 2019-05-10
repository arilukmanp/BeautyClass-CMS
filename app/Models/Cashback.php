<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashback extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id', 'transaction_id', 'voucher_id', 'cashback'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function voucher()
    {
        return $this->belongsTo('App\Models\Voucher');
    }
}
