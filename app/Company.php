<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 'location', 'description', 'phone', 'proof', 'email'
    ];

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
