<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

session_start();

class SubscribeController extends Controller
{
    public function view()
    {
        return view('adminview.subscribelist');
    }
}
