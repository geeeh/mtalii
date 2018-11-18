<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'name', 'location', 'cost', 'activities', 'description', 'period', 'package', 'image', 'date'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

}
