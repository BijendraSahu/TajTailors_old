<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\UserMaster', 'user_id');
    }
}
