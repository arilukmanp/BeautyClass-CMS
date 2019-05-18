<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'email', 'phone', 'title', 'photo', 'description'
    ];

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
