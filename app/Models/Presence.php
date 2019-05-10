<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'user_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
