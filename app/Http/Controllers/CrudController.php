<?php

namespace App\Http\Controllers;

use App\Categorymaster;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function add_cat()
    {
        $cat_data = new Categorymaster();
        $cat_data->name = request('cat_name');
        $cat_data->description = request('cat_description');
        $cat_data->save();
        $maxid = Categorymaster::where('is_active', 1)->max('id');
        $fullrow = Categorymaster::where(['id' =>$maxid])->first();
        return $fullrow;
    }

    public function updatecat()
    {

        {
            $data = array(
                'name' => request('name'),
                'slug' => request('slug'),
                'description' => request('des'),
            );
            Categorymaster::where('id', request('ID'))
                ->update($data);
            return 'Successfully Added';
        }


    }

    public function deletecat()
    {

        {
            $data = array(
                'is_active' => 0,
            );
            Categorymaster::where('id', request('ID'))
                ->update($data);
            return 'Successfully deleted';
        }


    }
}
