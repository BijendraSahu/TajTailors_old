<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Blogmodel;
use App\ItemImages;
use App\ItemMaster;
use App\ItemPrice;
use App\Notify;
use App\OrderDescription;
use App\OrderMaster;
use App\Review;
use App\Subscribe;
use App\UserAddress;
use App\UserMaster;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class FrontendController extends Controller
{

    /**************************Login/Registration/profile************************************/
    public function login(Request $request)
    {
        $username = request('email');
        $password = request('password');
        $user = UserMaster::where(['is_active' => 1, 'email' => $username, 'password' => md5($password)])->orWhere(['is_active' => 1, 'contact' => $username, 'password' => md5($password)])->first();
        if ($user != null) {
            $_SESSION['user_master'] = $user;
            return Redirect::back();
        } else
            return Redirect::back()->withInput()->withErrors(array('message' => 'Email or password Invalid'));
    }

    public function user_home()
    {
        if (isset($_SESSION['user_master'])) {
            if (!is_null($_SESSION['user_master'])) {
                $user_ses = $_SESSION['user_master'];
                $user = UserMaster::find($user_ses->id);
                return view('web.home')->with(['user' => $user]);
            } else {
                $_SESSION['user_master'] = null;
                return view('web.home');
            }
        }
        return view('web.home');
    }

    public function my_profile()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserMaster::find($user_ses->id);
            return view('web.my_profile')->with(['user' => $user]);
        } else {
            return Redirect::back()->withInput()->withErrors(array('message' => 'Please login first'));
        }
    }

    public function profile_update_old(Request $request)
    {
        $user = $_SESSION['user_master'];
        $user = UserMaster::find($user->id);
        $email = request('email');
        $mobile = request('contact');
        $useremail = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and email = '$email'");
        $usermob = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and contact = '$mobile'");
        if (isset($useremail)) {
            return 'Email is already exist';
        } elseif (isset($usermob)) {
            return 'Contact is already exist';
        } else {
            $user->name = request('name');
            $user->email = request('email');
            $user->contact = request('contact');
            $file = $request->file('profile_img');
            if ($request->file('profile_img') != null) {
                $destination_path = 'u_img/' . $user->id . '/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $file->move($destination_path, $filename);
                $user->profile_img = $filename;
            }
            $user->save();
            return 'success';
        }
    }

    public function profile_update(Request $request)
    {
        $user = $_SESSION['user_master'];
        $user = UserMaster::find($user->id);
        $email = request('email');
        $mobile = request('contact');
        $useremail = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and email = '$email'");
        $usermob = DB::selectone("SELECT * FROM `users` WHERE id != $user->id and contact = '$mobile'");
        if (isset($useremail)) {
            return 'Email is already exist';
        } elseif (isset($usermob)) {
            return 'Contact is already exist';
        } else {
            $user->name = request('name');
            $user->email = request('email');
            $user->contact = request('contact');
            $file = $request->file('profile_img');
            if ($request->file('profile_img') != null) {
                $destination_path = 'u_img/' . $user->id . '/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $file->move($destination_path, $filename);
                $user->profile_img = $filename;
            }
            $user->save();
            return redirect('my_profile')->with('message', 'Profile has been updated');
        }
    }

    public function removeProfile(Request $request)
    {
        $user = UserMaster::find($_SESSION['user_master']->id);
        if (isset($user)) {
            $user->profile_img = 'images/Male_default.png';
            $user->save();
            $ret['response'] = 'Profile Pic has been removed';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function change_password()
    {
        $curr_pass = $_SESSION['user_master']->password;
        if (md5(request('oldpassword')) == $curr_pass) {
            $user = UserMaster::find($_SESSION['user_master']->id);
            $user->password = md5(request('newpassword'));
            $user->save();
            $_SESSION['user_master'] = $user;
            echo 'ok';
        } else
            echo 'Incorrect';
    }
    /**************************Login/Registration/profile************************************/


    /**************************Items************************************/
    public function product_details($eid)
    {
        $id = decrypt($eid);
        $item = ItemMaster::find($id);
        $item_images = ItemImages::where(['item_master_id' => $item->id])->get();
        $item_prices = ItemPrice::where(['item_master_id' => $item->id])->get();
        return view('web.product_details')->with(['item' => $item, 'item_images' => $item_images, 'item_prices' => $item_prices]);
    }

    /**********Product Feedback*********/
    public function product_feedback()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserMaster::find($user_ses->id);
            $orders = DB::select("SELECT o.*,od.id as ods_id, od.total, od.qty, od.item_master_id FROM order_description od, order_master o WHERE od.order_master_id = o.id");
//            $s = "SELECT * FROM order_master o WHERE o.user_id = $user->id ORDER BY o.id DESC";
//            $items = DB::select($s);
//            $results = array();
//            if (count($items) > 0)
//                foreach ($items as $item) {
//                    $orders_des = DB::select("select od.* from order_description od where od.order_master_id = $item->id");
//                    $results[] = ['id' => $item->id, 'order_no' => $item->order_no, 'status' => $item->status, 'orders_des' => $orders_des];
//                }
//                echo json_encode($orders);
            return view('web.product_feedback')->with(['orders' => $orders]);

        } else
            return Redirect::back()->withInput()->withErrors(array('message' => 'Email or password Invalid'));
    }

    public function submit_feedback()
    {
        $order_des_id = request('order_des_id');
        $review = new Review();
        $review->user_id = $_SESSION['user_master']->id;
        $review->item_master_id = request('item_id');
        $review->order_description_id = $order_des_id;
        $review->name = $_SESSION['user_master']->name;
        $review->email = $_SESSION['user_master']->email;
        $review->review = request('review');
        $review->star_rating = request('star_rating');
        $review->save();
        echo 'success';

    }

    /**********Product Feedback*********/

    public function product_list()
    {
        $categories = DB::table('category_master')->where('is_active', '1')->get();
        $fabrics = DB::table('fabric')->where('is_active', '1')->get();
        return view('web.product_list')->with(['categories' => $categories, 'fabrics' => $fabrics]);
    }

    public function view_item()//modal
    {
        $item_id = request('item_id');
        $item = ItemMaster::find($item_id);
        $item_images = ItemImages::where(['item_master_id' => $item_id])->get();
        $item_prices = ItemPrice::where(['item_master_id' => $item_id])->get();
        return view('web.view_product')->with(['item' => $item, 'item_images' => $item_images, 'item_prices' => $item_prices]);
    }

    public function getmoreproducts()
    {
        $category_id = request('category_id');
        $qry = '';

        $all = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id";
        $by_id = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id";
        $a = ($category_id == 0) ? $all : $by_id;
        $products_c = DB::select($a);
        $numrows = count($products_c);
        $rowsperpage = 8;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }

        $offset = ($currentpage - 1) * $rowsperpage;
        $all = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $by_id = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $s = ($category_id == 0) ? $all : $by_id;
//        $s = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $items = DB::select($s);
        if ($numrows > 0) {
            return view('web.product_load')->with(['items' => $items, 'items_count' => $numrows]);
        } else {
            return response()->json(array('no_record' => 'no_record'));
        }
    }

    public function getFabricproducts()
    {
        $qry = '';
//        echo json_encode(request('fabric_id'));
        $fabric_id = join(', ',  request('fabric_id'));

        $by_id = "SELECT i.* FROM item_master i, item_fabric ifb where ifb.item_master_id = i.id and ifb.fabric_id in ($fabric_id)";
        $products_c = DB::select($by_id);
        $numrows = count($products_c);
        $rowsperpage = 8;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }

        $offset = ($currentpage - 1) * $rowsperpage;
        $by_id = "SELECT i.* FROM item_master i, item_fabric ifb where ifb.item_master_id = i.id and ifb.fabric_id in ($fabric_id) ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $items = DB::select($by_id);
        if ($numrows > 0) {
            return view('web.product_load')->with(['items' => $items, 'items_count' => $numrows]);
        } else {
            return response()->json(array('no_record' => 'no_record'));
        }
    }

    public function getPriceproducts()
    {
        $min_price = request('min_price');
        $max_price = request('max_price');
        $category_id = request('category_id');
        $qry = '';

        $all = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and price >= $min_price and price <=$max_price";
        $by_id = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id and price >= $min_price and price <=$max_price";
        $a = ($category_id == 0) ? $all : $by_id;
        $products_c = DB::select($a);
        $numrows = count($products_c);
        $rowsperpage = 8;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }

        $offset = ($currentpage - 1) * $rowsperpage;
        $all = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and price >= $min_price and price <=$max_price ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $by_id = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id and price >= $min_price and price <=$max_price ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $s = ($category_id == 0) ? $all : $by_id;
//        $s = "SELECT i.* FROM item_master i, item_category ic where ic.item_master_id = i.id and ic.category_id = $category_id ORDER BY i.id DESC LIMIT $offset,$rowsperpage";
        $items = DB::select($s);
        if ($numrows > 0) {
            return view('web.product_load')->with(['items' => $items, 'items_count' => $numrows]);
        } else {
            return response()->json(array('no_record' => 'no_record'));
        }
    }
    /**************************Items************************************/


    /**************************Address************************************/
    public function getexistaddress()
    {
        $address = UserAddress::find(request('address_id'));
        return response()->json(array('name' => $address->name, 'email' => $address->email, 'contact' => $address->contact, 'address' => $address->address, 'city_id' => $address->city_id, 'pincode' => $address->zip));
    }

    public function address_update()
    {
//        echo json_encode(request('test_record'));
        if (request('existaddress') > 0) {
            $address = UserAddress::find(request('existaddress'));
            $address->name = request('add_name');
            $address->email = request('add_email');
            $address->contact = request('add_contact');
            $address->address = request('add_address');
            $address->zip = request('add_pincode');
            $address->city_id = request('add_city');
            $address->save();
            return 'success';
        } else {
            $new_add = new UserAddress();
            $new_add->user_id = $_SESSION['user_master']->id;
            $new_add->name = request('add_name');
            $new_add->email = request('add_email');
            $new_add->contact = request('add_contact');
            $new_add->address = request('add_address');
            $new_add->zip = request('add_pincode');
            $new_add->city_id = request('add_city');
            $new_add->save();
            return 'success';
        }
    }


    /**************************Address************************************/


    /**************************Subscribe************************************/
    public function subscribe(Request $request)
    {
        $email = request('email');
        Subscribe::where(['email' => $email])->delete();
        $subscribe = new Subscribe();
        $subscribe->email = $email;
        $subscribe->save();
        return 'Success';
    }
    /**************************Subscribe************************************/


    /**************************Appointment************************************/
    public function take_appointment()
    {
        $appointment = new Appointment();
        $appointment->name = request('name');
        $appointment->email = request('email');
        $appointment->contact = request('contact');
        $appointment->appointment_date = Carbon::parse(request('appointment_date'))->format('Y-m-d');
        $appointment->appointment_time = request('appointment_time');
        $appointment->address = request('address');
        $appointment->save();
        return 'success';
//        return redirect('book_appointment')->with('message', 'Your appointment request has been saved we will get back to you soon');
    }
    /**************************Appointment************************************/


    /**************************Cart************************************/
    public function mycart()
    {
        return view('web.mycart');
    }
    /** ************************Cart************************************/


    /**************************Checkout Confirm************************************/
    public function checkout()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserMaster::find($user_ses->id);
            $states = DB::select("select * from cities order by state ASC");
            $cities = DB::select("select * from cities where city IS NOT NULL order by city ASC");
            return view('web.checkout')->with(['user' => $user, 'cities' => $cities]);
        } else {
            return Redirect::back()->withInput()->withErrors(array('message' => 'Please login first'));
        }
    }

    public function confirm_order(Request $request)
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
            $address_id = request('add_id');
            $shipping = request('udf2');
//            $selected_point = request('selected_point');
//            $selected_promo = request('selected_promo');
//            if ($selected_point > 0) {
//                $user_master = UserMaster::find($user->id);
//                $user_master->gain_amount = 0;
//                $user_master->save();
//            }

            $order = new OrderMaster();
            $order->order_no = rand(100000, 999999);
            $order->user_id = $user->id;
            $order->address_id = $address_id;
            $order->status = 'Ordered';
            $order->delivery_charge = request('delivery_charge');
            $order->bill_amount = $cart_total;
//            $order->point_pay = $selected_point == '' ? 0 : $selected_point;
//            $order->promo_pay = $selected_promo == '' ? 0 : $selected_promo;
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
            /*$pointAmt = $cart_total * 0.2 / 100;

            $queryResult = DB::select("call getParentId($user->id)");
            if (count($queryResult) > 0) {
                if (count($queryResult) >= 4) {
                    for ($i = 0; $i < 4; $i++) {
                        $puser = UserMaster::find($queryResult[$i]->parent_id);
                        $puser->gain_amount += $pointAmt;
                        $puser->save();
                    }
                } else {
                    foreach ($queryResult as $parent_id) {
                        $puser = UserMaster::find($parent_id->parent_id);
                        $puser->gain_amount += $pointAmt;
                        $puser->save();
                    }
                }
            }*/

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
                $mail->subject = 'Taj Tailors - Support Team';
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
    /**************************Checkout Confirm************************************/


    /**************************Orders************************************/
    public function order_list()
    {
        if (isset($_SESSION['user_master'])) {
            $orders = DB::select("SELECT * FROM order_description od, order_master o WHERE od.order_master_id = o.id");
            return view('web.order_list')->with(['orders' => $orders]);
        } else {
            return Redirect::back()->withInput()->withErrors(array('message' => 'Please login first'));
        }
    }

    /**************************Orders************************************/

    public function web_check_promo(Request $request)
    {
        $promo_code = request('promo_code');
        $promo_amt = DB::selectOne("select promo_amount from promo where promo_code = '$promo_code' and is_active= '1'");
        if (isset($promo_amt)) {
            echo $promo_amt->promo_amount;
        } else {
            echo 'Invalid';
        }

    }


    /**************************Blog************************************/
    public function blog_list()
    {
        $blogs = Blogmodel::where(['is_active' => 1])->get();
        return view('web.blog')->with(['blogs' => $blogs]);
    }

    public function about()
    {
        return view('web.about');
    }

    public function contact_us()
    {
        return view('web.contact_us');
    }

    public function return_policy()
    {
        return view('web.return_policy');
    }

    public function terms_conditions()
    {
        return view('web.terms_conditions');
    }

    public function book_appointment()
    {
        return view('web.book_appointment');
    }

    public function notify()
    {
        $data = new Notify();
        $data->item_master_id = request('item_master_id');
        $data->email = request('email');
        $data->contact = request('contact');
        $data->message = request('message');
        $data->save();
        echo 'success';
    }

    public function view_blog($eid)
    {
        $id = decrypt($eid);
        $blog = Blogmodel::find($id);
        return view('web.view_blog')->with(['blog' => $blog]);
    }
    /**************************Blog************************************/

}
