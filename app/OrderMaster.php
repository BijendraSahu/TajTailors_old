<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $table = 'order_master';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\UserMaster', 'user_id');
    }

    public function user_address()
    {
        return $this->belongsTo('App\UserAddress', 'address_id');
    }
}
