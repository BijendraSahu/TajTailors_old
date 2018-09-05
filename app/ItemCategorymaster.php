<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategorymaster extends Model
{
    protected $table = 'item_category';
    public $timestamps = false;


    public function cat_name()
    {
        return $this->belongsTo('App\Categorymaster', 'category_id');
    }
}
