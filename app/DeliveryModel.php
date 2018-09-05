<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryModel extends Model
{
    protected $table = 'delivery_charges';
    public $timestamps = false;


    public function cityname()
    {
        return $this->belongsTo('App\CityModel', 'city_id');
    }
}
