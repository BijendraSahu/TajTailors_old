<?php

namespace App\Http\Controllers;

use App\OrderDescription;
use App\OrderMaster;
use App\UserAddress;
use App\UserMaster;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class CartController extends Controller
{
    public function cartload()
    {
        $cart = Cart::content();
        return view('web.cart.cart_load')->with(['cart' => $cart]);
    }

    public function addtocart()
    {
        $item_id = request('itemid');
        $item_price_id = request('rateid');
        $products = DB::table('item_master')->where('id', $item_id)->first();
        $price = DB::table('item_price')->where('id', $item_price_id)->first();
//        echo json_encode($price);

        $quantity = request('quantity');
        $size = request('size');
        $product_name = $products->name;
        $product_price = $products->special_price > 0 ? $products->special_price : $products->price;

        if (isset($quantity) && $quantity != 0) {
            Cart::add($item_id, $product_name, $quantity, $product_price, ['size' => $size]);
        } else {
            Cart::add($item_id, $product_name, 1, $product_price, ['size' => $size]);
        }

        $cart = Cart::content();
        if (isset($cart) == 0) {
            \Session::forget('coupon_value');
            \Session::flash('success-msg', 'Cart Is Empty');
        }
        $cart_total = Cart::total();
        return view('web.cart.cart_load')->with(['cart' => $cart]);
    }

    public function cart_update($id)
    {
        $rowId = $id;
        $quantity = request('qty');
        Cart::update($rowId, $quantity);
//        Session::flash('success - msg', 'Successfully Updated');
        return redirect()->back();
    }

//    public function delete($id)
//    {
//        $rowId = $id;
//        Cart::remove($rowId);
////        \Session::flash('success-msg', 'Successfully Removed');
//        return redirect()->back();
//    }
    public function delete()
    {
        $rowId = request('cart_item_id');
        Cart::remove($rowId);
        $cart = Cart::content();
        return view('web.cart.cart_load')->with(['cart' => $cart]);
    }


    public function payment(Request $request)   //////////////////Final
    {
//        session_start();
        $cart = Cart::content();
        $user = $_SESSION['user_master'];
        $exist = UserAddress::find(request('existaddress'));
        $addressdel1 = $exist->name . ', ' . $exist->contact . ', ' . $exist->address;

        $address_id = request('existaddress');
        $selected_point = (request('selected_point') > 0) ? request('selected_point') : 0;
        $selected_promo = (request('selected_promo') > 0) ? request('selected_promo') : 0;
        define('SUCCESS_URL', 'http://18.222.69.192/success');  //have complete url
        define('FAIL_URL', 'http://18.222.69.192/failed');    //add complete url
        $MERCHANT_KEY = "uuost9YW";
        $SALT = "STCIocBzJD";
//        $MERCHANT_KEY = "mqqqWtY9";
//        $SALT = "x2fGRxrwL7";
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $email = $exist->email;
        $firstName = str_replace(' ', '', $exist->name);
        $amt = request('amt');
//        $amt_pum = request('amt') * 3 / 100;
        $totalCost = $amt;
        $mobile = $exist->contact;
        $shipping = (request('delivery_charge') > 0) ? request('delivery_charge') : 0;
        $hash = '';
        $hash_string = $MERCHANT_KEY . "|" . $txnid . "|" . $totalCost . "|" . "product|" . $firstName . "|" . $email . "|1|" . $shipping . "|" . $selected_point . "|" . $selected_promo . "|" . $address_id . "||||||" . $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        $_SESSION['total_amt'] = $totalCost;
        return view('web.pay_umoney_form')->with(['hash1' => $hash, 'amt' => $amt, 'txnid' => $txnid, 'totalCost' => $totalCost, 'firstName' => $firstName, 'MERCHANT_KEY' => $MERCHANT_KEY, 'SALT' => $SALT, 'addressdel1' => $addressdel1, 'email' => $email, 'mobile' => $mobile, 'address_id' => $address_id, 'hash_string' => $hash_string, 'shipping' => $shipping, 'selected_promo' => $selected_promo, 'selected_point' => $selected_point]);

    }

    public function payment_failed()
    {
//        echo json_encode($_REQUEST);
//        return view('front.failed');
        return redirect('checkout')->withErrors(array('message' => 'Payment has been failed please try again...'));
    }

    public function payment_success(Request $request)
    {
        $cart = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $user = UserMaster::find($_SESSION['user_master']->id);
        if (count($cart) == 0) {
            return redirect('checkout')->withInput()->withErrors('Your cart is empty');
        } else {
            $cart_total = 0;
            foreach ($cart as $row) {
                $cart_total += $row->price * $row->qty;
            }
//            $address_id = request('add_id');
//            $shipping = request('udf2');
//            $selected_point = request('selected_point');
//            $selected_promo = request('selected_promo');

            $shipping = request('udf2');
            $selected_point = request('udf3');
            $selected_promo = request('udf4');
            $address_id = request('udf5');

            if ($selected_point > 0) {
                $user_master = UserMaster::find($user->id);
                $user_master->gain_amount = 0;
                $user_master->save();
            }

            $order = new OrderMaster();
            $order->order_no = rand(100000, 999999);
            $order->user_id = $user->id;
            $order->address_id = $address_id;
            $order->status = 'Ordered';
            $order->delivery_charge = $shipping == 0 ? '0' : $shipping;
            $order->bill_amount = $cart_total;
            $order->point_pay = $selected_point == '' ? 0 : $selected_point;
            $order->promo_pay = $selected_promo == '' ? 0 : $selected_promo;
            $order->paid_amt = request('amount');
            $order->order_date = Carbon::now('Asia/Kolkata');
            $order->save();
            foreach ($cart as $row) {
                $order_des = new OrderDescription();
                $order_des->order_master_id = $order->id;
                $order_des->item_master_id = $row->id;
                $order_des->qty = $row->qty;
                $order_des->size = ($row->options->has('size') ? $row->options->size : '');
                $order_des->unit_price = $row->price;
                $order_des->total = $row->price * $row->qty;
                $order_des->save();
            }
            \Gloudemans\Shoppingcart\Facades\Cart::destroy();

            /********0.2% Amount Distribution*********/
//            $total_amt = DB::selectOne("SELECT SUM(total) as total_amt FROM `order_description` WHERE order_master_id = $order->id");
//            $pointAmt = $cart_total * 0.2 / 100;
//
//            $queryResult = DB::select("call getParentId($user->id)");
//            if (count($queryResult) > 0) {
//                if (count($queryResult) >= 4) {
//                    for ($i = 0; $i < 4; $i++) {
//                        $puser = UserMaster::find($queryResult[$i]->parent_id);
//                        $puser->gain_amount += $pointAmt;
//                        $puser->save();
//                    }
//                } else {
//                    foreach ($queryResult as $parent_id) {
//                        $puser = UserMaster::find($parent_id->parent_id);
//                        $puser->gain_amount += $pointAmt;
//                        $puser->save();
//                    }
//                }
//            }

            $address = UserAddress::find($address_id);
            $name = str_replace(' ', '', $address->name);

            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$address->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20$name,%20Your%20order has%20been%20placed%20your%20order%20no%20is%20TajTailors$order->order_no");

            /********0.2% Amount Distribution*********/

            $allmails = [$address->email];

            foreach ($allmails as $mail) {
                $email[] = $mail;
            }
            if (count($email) > 0) {
                $mail = new \App\Mail();
                $mail->to = implode(",", $email);
                $mail->subject = 'Organic Dolchi - Support Team';
                $siteurl = 'http://www.organicdolchi.com/';
                $username = $address->name;
//                $salutation = ($user->gender == 'male') ? 'Mr.' : 'Mrs.';

                $message = '<table width="650" cellpadding="0" cellspacing="0" align="center" style="background-color:#ececec;padding:40px;font-family:sans-serif;overflow:scroll"><tbody><tr><td><table cellpadding="0" cellspacing="0" align="center" width="100%"><tbody><tr><td><div style="line-height:50px;text-align:center;background-color:#fff;border-radius:5px;padding:20px"><a href="' . $siteurl . '" target="_blank" ><img src="' . $siteurl . 'images/organic_logo.png"></a></div></td></tr><tr><td><div><img src="' . $siteurl . 'images/acknowledgement.jpg" style="height:auto;width:100%;" tabindex="0"><div dir="ltr" style="opacity: 0.01; left: 775px; top: 343px;"><div><div class="aSK J-J5-Ji aYr"></div></div></div></div></td></tr><tr><td style="background-color:#fff;padding:20px;border-radius:0px 0px 5px 5px;font-size:14px"><div style="width:100%"><h1 style="color:#007cc2;text-align:center">Thank you ' /*. $salutation . ' '*/ . $username . '</h1><p style="font-size:14px;text-align:center;color:#333;padding:10px 20px 10px 20px">Thank you forshopping with organicdolchi. organicdolchi.com is a Quick and easy shopping: Online/ Telephonic Call-back facility. Free Home Delivery: The products are delivered in 2 working days or less and your doorsteps. Convenient Payment Options: Payment via net banking facility, Payumoney and Indian credit/debit cards. We also accept Cash on Delivery<br/></p></div></td></tr></tbody></table></td></tr><tr><td style="padding:20px;font-size:12px;color:#797979;text-align:center;line-height:20px;border-radius:5px 5px 0px 0px">DISCLAIMER - The information contained in this electronic message (including any accompanying documents) is solely intended for the information of the addressee(s) not be reproduced or redistributed or passed on directly or indirectly in any form to any other person.</td></tr></tbody></table>';
                $mail->body = $message;
                if ($mail->send_mail()) {
                    //return redirect('mail')->withErrors('Email sent...');
                } else {
                    //return redirect('mail')->withInput()->withErrors('Something went wrong. Please contact admin');
                }
            }

            return redirect('checkout')->with('message', 'Your order has been successful...you will get confirmation mail');
        }
    }


}
