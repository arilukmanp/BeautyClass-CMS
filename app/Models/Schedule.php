<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'category_id', 'speaker_id', 'name', 'time', 'description', 'for_day'
    ];

    public function schedule_category()
    {
        return $this->belongsTo('App\Models\Schedule_category');
    }

    public function speaker()
    {
        return $this->belongsTo('App\Models\Speaker');
    }
}
