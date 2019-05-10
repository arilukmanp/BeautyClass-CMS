<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'email', 'password', 'token', 'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function voucher()
    {
        return $this->hasMany('App\Models\Voucher');
    }

    public function coupon()
    {
        return $this->hasMany('App\Models\Coupon');
    }

    public function cashback()
    {
        return $this->hasMany('App\Models\Cashback');
    }

    public function presence()
    {
        return $this->hasOne('App\Models\Presence');
    }

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction');
    }

    public function isAdmin()
    {
        if(($this->role == 3) || ($this->role == 2)){
            return true;
        }
        return false;
    }
}
