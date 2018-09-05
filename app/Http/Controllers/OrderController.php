<?php

namespace App\Http\Controllers;

use App\OrderDetails;
use App\OrderMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();

class OrderController extends Controller
{
public function orderlist()
{
    $orderdata=OrderMaster::get();
    $orderdetails=OrderDetails::get();
    return view('adminview.allorder',['orderdata'=>$orderdata,'orderdetails'=>$orderdetails]);
}


public function ordered()
{
    $idd=request('IDD');$data = array(
    'status' => 'Ordered',
    'updated_time'=>date("d-m-Y")
);
    OrderMaster::where('id', request('IDD'))
        ->update($data);
    return 1;
}
public function packed()
{
    $idd=request('IDD');$data = array(
    'status' => 'Packed',
    'updated_time'=>date("d-m-Y")
);
    OrderMaster::where('id', request('IDD'))
        ->update($data);
    return 1;
}
public function shipped()
{
    $idd=request('IDD');$data = array(
    'status' => 'Shipped',
    'updated_time'=>date("d-m-Y")
);
    OrderMaster::where('id', request('IDD'))
        ->update($data);
    return 1;
}
public function delivered()
{
    $idd=request('IDD');$data = array(
    'status' => 'Delivered',
    'updated_time'=>date("d-m-Y")
);
    OrderMaster::where('id', request('IDD'))
        ->update($data);
    return 1;
}
public function active_order()
{
    $idd=request('IDD');
    $data = array(
    'is_active' => '1'
);
    OrderMaster::where('id', request('IDD'))
        ->update($data);
    return 1;
}

    public function inactive_order()
    {
        $idd=request('IDD');
        $data = array(
        'is_active' => '0'
    );
        OrderMaster::where('id', request('IDD'))
            ->update($data);
        return 1;
    }



 public function more_order($id)
    {
        $order_data = OrderMaster::find($id);
        $order_details = OrderDetails::where(['order_master_id' => $id])->get();

        return view('adminview.order_full_details',['order_data'=> $order_data, 'order_details'=> $order_details]);
    }
    public function bill_order($id)
    {
        $order_data = OrderMaster::find($id);
        $order_details = OrderDetails::where(['order_master_id' => $id])->get();
        $total_price=DB::select("select sum(total) as total FROM order_description WHERE order_master_id=$id");
        /*return $total_price;*/

        return view('adminview.bill_order',['order_data'=> $order_data, 'order_details'=> $order_details, 'total_price'=> $total_price]);
    }

}
