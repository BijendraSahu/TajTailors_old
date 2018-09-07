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
        $rfcode = UserMaster::where(['contact' => request('ref_code')])->first();

        if (isset($useremail)) {
            return 'email Address is Already Linked With Another Account!!!';
        } elseif (isset($usermob)) {
            return 'Mobile Number Already Linked With Another Account!!!!!!';
        } elseif (!isset($rfcode)) {
            return 'Please Enter a valid referral code';
        } else {
            $data = new UserMaster();
            $data->rc = request('ref_code');
            $data->name = request('user_name');
            $data->email = request('email_id');
            $data->contact = request('mobile');
            $data->password = md5(request('password'));
            $data->save();
            $this->CreateRelation(request('ref_code'), $data->id);
            return 'Success';
        }
    }

    public
    function CreateRelation($rfrcd, $user_id)
    {
        if (empty($rfrcd))
            $rfrcd = 0;
        // parent_id is referal_id here, Usinf Id as referal_id
        $add_rltns = array('parent_id' => $rfrcd, 'child_id' => $user_id);
        DB::table('relations')->insert($add_rltns);
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
