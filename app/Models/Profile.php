<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'class_id', 'name', 'place_of_birth', 'date_of_birth', 'address', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
