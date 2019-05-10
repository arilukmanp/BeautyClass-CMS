<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $timestamps = false;
    
    protected $fillable = [
        'speaker_id', 'for_date', 'category', 'name', 'description'
    ];

    public function speaker()
    {
        return $this->belongsTo('App\Models\Speaker');
    }
}
