<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucketlist extends Model
{
    //
    protected $table='bucketlist';

    protected $fillable = [
        'name', 'type'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
