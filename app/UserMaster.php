<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    protected $table = 'users';
    public $timestamps = false;

    public function city_name()
    {
        return $this->belongsTo('App\CityModel', 'city_id');
    }
}
