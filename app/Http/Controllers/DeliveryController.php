<?php

namespace App\Http\Controllers;

use App\CityModel;
use App\DeliveryModel;
use Illuminate\Http\Request;
session_start();

class DeliveryController extends Controller
{
    public function delivery()
    {
        $citydata=CityModel::get();
        $deliverydata=DeliveryModel::get();
        return view('adminview.delivery',['citydata'=>$citydata, 'deliverydata'=>$deliverydata]);
    }
    public function add_delivery()
    {
        $data= new DeliveryModel();
        $data->city_id = request('cityid');
        $data->area = request('area');
        $data->pin = request('pin');
        $data->amount = request('amount');
        $data->delivery_charge = request('del_charge');
        $data->save();
        return'success';
    }
    public function update_delivery()
    {
        $data = array(
            'city_id' => request('cityid'),
            'area' => request('area'),
            'pin' => request('pin'),
            'amount' => request('amount'),
            'delivery_charge' => request('del_charge'),
        );
        DeliveryModel::where('id', request('idd'))
            ->update($data);
        return '1';

    /* echo request('cityid').request('area').request('pin').request('amount').request('del_charge').request('idd');*/
    }
    public function delete_del()
    {
        $data = array(

            'is_active' =>'0',
        );
        DeliveryModel::where('id', request('idd'))
            ->update($data);
        return '1';

    /* echo request('cityid').request('area').request('pin').request('amount').request('del_charge').request('idd');*/
    }
}
