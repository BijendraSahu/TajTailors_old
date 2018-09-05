<?php

namespace App\Http\Controllers;

use App\CategoryMaster;
use App\ItemMaster;
use App\OrderDescription;
use App\OrderMaster;
use App\Review;
use App\UserAddress;
use App\UserMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class APIController extends Controller
{

    /**************Rest API Function**************/
    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**************Rest API Function**************/


    public function getCategory()
    {
        $categories = CategoryMaster::where(['is_active' => 1])->get();
        if (count($categories) > 0) {
            return $this->sendResponse($categories, 'Category List');
        } else {
            return $this->sendError('No Category available', '');
        }
    }

    public function get_item_by_cid(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $items = ItemMaster::getItemBycid();
        if (count($items) > 0) {
            return $this->sendResponse($items, 'Item List');
        } else {
            return $this->sendError('No Item available', '');
        }
    }

    public function get_item_by_id(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $items = ItemMaster::getItemByid();
        if (count($items) > 0) {
            return $this->sendResponse($items, 'Item List');
        } else {
            return $this->sendError('No Item available', '');
        }
    }

    public function searchitem(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'item_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $s = request('item_name');
        $product = DB::select("SELECT i.id, i.name, im.image FROM item_master i, item_images im WHERE i.id = im.item_master_id and i.name LIKE '$s%'");
        if (count($product) > 0) {
            return $this->sendResponse($product, 'Item List');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    public function getlogin(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'mobile_email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $mobile_email = request('mobile_email');
        $password = md5(request('password'));
        $user = DB::selectone("SELECT * FROM `users` WHERE (is_active = 1 and contact = '$mobile_email' and password = '$password') or (is_active = 1 and email = '$mobile_email' and password = '$password')");
        if (isset($user)) {
            return $this->sendResponse($user, 'User Record');
        } else {
            return $this->sendError('Email/Mobile Number or Password is Invalid', '');
        }
    }

    public function getregister(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $useremail = UserMaster::where(['email' => request('email')])->first();
        $usermob = UserMaster::where(['contact' => request('mobile')])->first();
        if (isset($useremail)) {
            return $this->sendError('Email is already exist', '');
        } elseif (isset($usermob)) {
            return $this->sendError('Contact is already exist', '');
        } else {
            $user = new UserMaster();
            $user->rc = request('ref_code');
            $user->name = request('name');
            $user->email = request('email');
            $user->contact = request('mobile');
            $user->password = md5(request('password'));
            $user->save();
            return $this->sendResponse($user, 'Registration has been successful...');
        }
    }

    public function edit_profile(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = UserMaster::find(request('user_id'));
        if (isset($user)) {
            $email = request('email');
            $mobile = request('mobile');
            $useremail = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and email = '$email'");
            $usermob = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and contact = '$mobile'");
            if (isset($useremail)) {
                return $this->sendError('Email is already exist', '');
            } elseif (isset($usermob)) {
                return $this->sendError('Contact is already exist', '');
            } else {
                $user->name = request('name');
                $user->email = request('email');
                $user->contact = request('mobile');
                $file = $request->file('profile_img');
                if ($request->file('profile_img') != null) {
                    $destination_path = 'u_img/' . $user->id . '/';
                    $filename = str_random(6) . '_' . $file->getClientOriginalName();
                    $file->move($destination_path, $filename);
                    $user->profile_img = $filename;
                }
                $user->save();
                return $this->sendResponse($user, 'Profile has been updated...');
            }
        } else {
            return $this->sendError('No record found', '');
        }
    }

    /**************Address API**********************/
    public function insert_user_address(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'pincode' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $client_address = new UserAddress();
        $client_address->user_id = request('user_id');
        $client_address->name = request('name');
        $client_address->contact = request('phone');
        $client_address->email = request('email');
        $client_address->address = request('address');
        $client_address->address2 = request('address2');
        $client_address->zip = request('pincode');
        $client_address->city_id = request('city_id');
        $client_address->state_id = request('state_id');
        $client_address->save();
        return $this->sendResponse($client_address, 'Address has been saved');
    }

    public function update_user_address(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'address_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'pincode' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $client_address = UserAddress::find(request('address_id'));
        if (isset($client_address)) {
            $client_address->name = request('name');
            $client_address->contact = request('contact');
            $client_address->email = request('email');
            $client_address->address = request('address');
            $client_address->address2 = request('address2');
            $client_address->zip = request('pincode');
            $client_address->city_id = request('city_id');
            $client_address->state_id = request('state_id');
            $client_address->save();
            return $this->sendResponse($client_address, 'Address has been updated');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    public function getaddress(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user_id = request('user_id');
        $user_addresses = DB::select("select u.*, (select c.state from cities c where u.state_id = c.id) as state, (select c.state from cities c where u.city_id = c.id) as city from user_address u where user_id = '$user_id'");
        if (count($user_addresses) > 0) {
            return $this->sendResponse($user_addresses, 'User Address List');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    public function getaddressbyid(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user_addresses = UserAddress::find(request('address_id'));
        if (isset($user_addresses) > 0) {
            return $this->sendResponse($user_addresses, 'User Address');
        } else {
            return $this->sendError('No record available', '');
        }
    }
    /**************Address API**********************/

    /**************Reviews API**********************/
    public function insert_review(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'item_master_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'review' => 'required',
            'star_rating' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $review = new Review();
        $review->user_id = request('user_id');
        $review->item_master_id = request('item_master_id');
        $review->name = request('name');
        $review->email = request('email');
        $review->review = request('review');
        $review->star_rating = request('star_rating');
        $review->save();
        return $this->sendResponse($review, 'Review has been saved');
    }

    public function getreview(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'item_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $review = Review::where(['item_master_id' => request('item_id')])->first();
        if (isset($review)) {
            return $this->sendResponse($review, 'Review List');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    /**************Reviews API**********************/


    public function delivery_charge(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $total = request('total');
        $pin = request('pin');
        if (!isset($pin)) {
            $delivery_charge = DB::selectOne("select delivery_charge from delivery_charges where amount>$total and is_active= '1'");
            return $this->sendResponse($delivery_charge, 'Delivery Charge');
        } else {
            $delivery_charge = DB::selectOne("select delivery_charge from delivery_charges where amount>$total and is_active= '1' and pin = '$pin'");
            return $this->sendResponse($delivery_charge, 'Delivery Charge');
        }
    }

    public function change_password(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user_id = request('user_id');
        $password = request('password');
        $user = UserMaster::find($user_id);
        if ($user != null) {
            $user->password = md5($password);
            $user->save();
            return $this->sendResponse($user, 'Password has been changed..!');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    /**************************Checkout Confirm************************************/
    public function confirm_checkout(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'address_id' => 'required',
            'cart' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $total = request('total');
        $user_id = request('user_id');
        $address_id = request('address_id');
        $address = UserAddress::find($address_id);

        $delivery_charge = DB::selectOne("select delivery_charge from delivery_charges where amount>$total and is_active= '1' and pin = '$address->zip'");

        $order = new OrderMaster();
        $order->order_no = rand(100000, 999999);
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->status = 'Ordered';
        $order->delivery_charge = isset($delivery_charge) ? $delivery_charge : '0';
        $order->save();
        $cart = json_decode(request('cart'));
        foreach ($cart as $row) {
            $order_des = new OrderDescription();
            $order_des->order_master_id = $order->id;
            $order_des->item_master_id = $row->item_id;
            $order_des->qty = $row->qty;
            $order_des->unit_price = $row->unit_price;
            $order_des->total = $row->total;
            $order_des->save();
        }
        return $this->sendResponse($order, 'Order has been successful...');
    }

    /**************************Checkout Confirm************************************/


    public function check_promo(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'promo_code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $promo_code = request('promo_code');

        $promo_amt = DB::selectOne("select promo_amount from promo where promo_code = '$promo_code' and is_active= '1'");
        if (isset($promo_amt)) {
            return $this->sendResponse($promo_amt, 'Promo amount');
        } else {
            return $this->sendError('No record available', '');
        }

    }

    public function getOrders()
    {
        $user_id = request('user_id');
        $orders = DB::select("SELECT o.*,od.id as ods_id, od.* FROM order_description od, order_master o WHERE o.user_id = $user_id and od.order_master_id = o.id");
        if (count($orders) > 0) {
            return $this->sendResponse($orders, 'User Orders list amount');
        } else {
            return $this->sendError('No record available', '');
        }
    }
}
