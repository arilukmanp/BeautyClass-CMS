<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'user_id', 'for_day'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
