<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reg_payment extends Model
{
    protected $fillable = [
        'name', 'email', 'to_bank', 'bank_account', 'amount', 'date_of_transfer', 'photo'
    ];
}
