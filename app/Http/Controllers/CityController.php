<?php

namespace App\Http\Controllers;

use App\CityModel;
use App\StateModel;
use Illuminate\Http\Request;
session_start();
class CityController extends Controller
{
    public function citylist()
    {
        $citydata=CityModel::get();
        $statedata=StateModel::get();
        return view('adminview.city',['citydata'=> $citydata,'statedata'=> $statedata]);
    }
    public function add_city()
    {
        $data = new CityModel();
        $data->city_name = request('city');
        $data->state_id = request('stateid');
        $data->save();
        return '1';
    }

    public function add_updatecity()
    {
        $data = array(
            'state_id' => request('stateid'),
            'city_name' => request('city')

        );
        CityModel::where('id', request('IDD'))
            ->update($data);
        return 1;
    }


    public function delete_city()
    {
        $data = array(
            'is_deleted' => '1',

        );
        CityModel::where('id', request('IDD'))
            ->update($data);
        return 1;
    }
}
