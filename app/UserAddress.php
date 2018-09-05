<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\Cities', 'city_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Cities', 'state_id');
    }

//    public
//    function scopegetAddressDropdown()
//    {
//        $addresses = UserAddress::where(['is_active' => '1', 'user_id'=> Auth::user()->id])->get(['id', 'address']);
//        $arr[0] = "SELECT";
//        foreach ($addresses as $address) {
//            $arr[$address->id] = $address->address;
//        }
//        return $arr;
//    }
}
