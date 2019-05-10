<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'event_name', 'eo_name', 'logo', 'app_description'
    ];
}
