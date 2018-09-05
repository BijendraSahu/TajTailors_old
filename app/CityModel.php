<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = 'cities';
    public $timestamps = false;


    public function cityname()
    {
        return $this->belongsTo('App\StateModel', 'state_id');
    }

}
