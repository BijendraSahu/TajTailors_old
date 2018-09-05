<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_description';
    public $timestamps = false;

    public function my_name()
    {
        return $this->belongsTo('App\ItemMaster', 'item_master_id');
    }
    public function my_image()
    {
        return $this->belongsTo('App\ItemImages', 'item_master_id');
    }
    public function myprice()
    {
        return $this->belongsTo('App\ItemPrice', 'item_master_id');
    }
}
