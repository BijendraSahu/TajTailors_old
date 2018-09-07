<?php

namespace App\Http\Controllers;

use App\UserMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class User_loginController extends Controller
{
    public function register()
    {
        $useremail = UserMaster::where(['email' => request('email_id')])->first();
        $usermob = UserMaster::where(['contact' => request('mobile')])->first();
        if (isset($useremail)) {
            return 'email Address is Already Linked With Another Account!!!';
        } elseif (isset($usermob)) {
            return 'Mobile Number Already Linked With Another Account!!!!!!';
        } else {
            $otp = rand(100000, 999999);
            $data = new UserMaster();
            $data->otp = $otp;
            $data->name = request('user_name');
            $data->email = request('email_id');
            $data->contact = request('mobile');
            $data->password = md5(request('password'));
            $data->save();
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$data->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20verify%20into%20your%20account%20is%20$otp");

            /***********Mail************/
            /*$allmails = [request('email_id')];

            foreach ($allmails as $mail) {
                $email[] = $mail;
            }
            if (count($email) > 0) {
                $mail = new \App\Mail();
                $mail->to = implode(",", $email);
                $mail->subject = 'Organic Dolchi - Support Team';
                $siteurl = 'https://www.connecting-one.com/';
                $username = request('user_name') . " " . request('lname');
                $salutation = request('gender') == 'male' ? "Mr." : "Ms.";

                $message = '<table width="650" cellpadding="0" cellspacing="0" align="center" style="background-color:#ececec;padding:40px;font-family:sans-serif;overflow:scroll"><tbody><tr><td><table cellpadding="0" cellspacing="0" align="center" width="100%"><tbody><tr><td><div style="line-height:50px;text-align:center;background-color:#fff;border-radius:5px;padding:20px"><a href="' . $siteurl . '" target="_blank" ><img src="' . $siteurl . 'images/logo.png"></a></div></td></tr><tr><td><div><img src="' . $siteurl . 'images/acknowledgement.jpg" style="height:auto;width:100%;" tabindex="0"><div dir="ltr" style="opacity: 0.01; left: 775px; top: 343px;"><div><div class="aSK J-J5-Ji aYr"></div></div></div></div></td></tr><tr><td style="background-color:#fff;padding:20px;border-radius:0px 0px 5px 5px;font-size:14px"><div style="width:100%"><h1 style="color:#007cc2;text-align:center">Thank you ' . $salutation . ' ' . $username . '</h1><p style="font-size:14px;text-align:center;color:#333;padding:10px 20px 10px 20px">Thank you for your registration in www.connecting-one.com is a unique Earning & advertising platform that brings together the socially conscious members & Advertisers.<br   /> Your otp is ' . $otp . '</p></div></td></tr></tbody></table></td></tr><tr><td style="padding:20px;font-size:12px;color:#797979;text-align:center;line-height:20px;border-radius:5px 5px 0px 0px">DISCLAIMER - The information contained in this electronic message (including any accompanying documents) is solely intended for the information of the addressee(s) not be reproduced or redistributed or passed on directly or indirectly in any form to any other person.</td></tr></tbody></table>';

                $mail->body = $message;
                if ($mail->send_mail()) {
                    //return redirect('mail')->withErrors('Email sent...');
                } else {
                    //return redirect('mail')->withInput()->withErrors('Something went wrong. Please contact admin');
                }
//            echo $message;
            }*/
            return 'Success';

        }
        /***********Mail************/
    }

    public
    function resend_otp()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserMaster::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user_master = UserMaster::find($user->id);
            $user_master->otp = $otp;
            $user_master->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user_master->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            $_SESSION['user_master'] = $user;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

    public
    function forgot_password()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserMaster::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user_master = UserMaster::find($user->id);
            $user_master->password = md5($otp);
            $user_master->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user_master->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");

            $_SESSION['user_master'] = $user_master;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

    public
    function verify_otp()
    {
        $otp = request('txtotp');
        $user = UserMaster::where(['otp' => $otp])->first();
        if (isset($user)) {
            $user_master = UserMaster::find($user->id);
            $user_master->is_confirmed = 1;
            $user_master->save();
            $_SESSION['user_master'] = $user_master;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

//    public
//    function checkrc()
//    {
//        $rc = request('rc');
//        $user_master = new UserMaster();
//        if (!$user_master->checkrc($rc)) {
//            echo 'already';
//        } else {
//            echo 'ok';
//        }
//    }

    public
    function checkno()
    {
        $contact = request('contact');
        $user_master = new UserMaster();
        if (!$user_master->checkcontact($contact)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }

    public
    function checkemail()
    {
        $email = request('email');
        $user_master = new UserMaster();
        if (!$user_master->checkemail($email)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }


    public function login()
    {
        $otp = rand(100000, 999999);
        $mobile = request('login_mobile');
        $password = md5(request('login_password'));
        $user = UserMaster::where(['contact' => $mobile, 'password' => $password])->first();
        if (isset($user)) {
            if ($user->is_active == 1) {
                if ($user->is_confirmed == 1) {
                    $_SESSION['user_master'] = $user;
                    return 'Login Success';
                } else {
                    $user->otp = $otp;
                    $user->save();
                    file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20Organic%20Dolchi%20user,Your%20verification%20code%20is%20$user->otp");
                    return 'Not Verified';
                }
            } else {
                return 'inactive';
            }
        } else {
            return "UserName/Password Invalid";
        }


    }


    public
    function userlist()
    {
        $user_data = UserMaster::paginate(10);
        return view('adminview.userlist', ['user_data' => $user_data]);
    }

    public
    function deactivate_user()
    {
        $data = array(
            'is_active' => '0'
        );
        UserMaster::where('id', request('IDD'))
            ->update($data);
        return 1;
    }


    public
    function activate_user()
    {
        $data = array(
            'is_active' => '1'
        );
        UserMaster::where('id', request('IDD'))
            ->update($data);
        return 1;
    }

    public
    function usershow($id)
    {
        $user_data = UserMaster::find($id);
        return view('adminview.show_user_full', ['user_data' => $user_data]);
    }

}
