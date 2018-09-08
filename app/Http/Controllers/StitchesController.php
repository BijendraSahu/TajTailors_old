<?php

namespace App\Http\Controllers;

use App\Stitches;
use Illuminate\Http\Request;

session_start();

class StitchesController extends Controller
{
    public function stitches_list()
    {
        $deliverydata = Stitches::where(['is_active' => 1])->get();
        return view('adminview.stitches', ['deliverydata' => $deliverydata]);
    }

    public function add_stitches()
    {
        $data = new Stitches();
        $data->product_name = request('product_name');
        $data->basic_price = request('basic_price');
        $data->premium_price = request('premium_price');
        $data->save();
        return 'success';
    }

    public function update_stitches()
    {
        $data = array(
            'product_name' => request('product_name'),
            'basic_price' => request('basic_price'),
            'premium_price' => request('premium_price'),
        );
        Stitches::where('id', request('idd'))
            ->update($data);
        return '1';

        /* echo request('cityid').request('area').request('pin').request('amount').request('del_charge').request('idd');*/
    }

    public function delete_stitches()
    {
        $data = array(
            'is_active' => '0',
        );
        Stitches::where('id', request('idd'))
            ->update($data);
        return '1';

        /* echo request('cityid').request('area').request('pin').request('amount').request('del_charge').request('idd');*/
    }
}
