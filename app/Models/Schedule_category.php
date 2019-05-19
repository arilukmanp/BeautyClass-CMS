<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule_category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name'
    ];

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
