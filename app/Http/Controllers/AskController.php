<?php

namespace App\Http\Controllers;

use App\AskModel;
use Illuminate\Http\Request;

session_start();

class AskController extends Controller
{
    public function ask()
    {
        $data = AskModel::get();
        return view('adminview.ask', ['data' => $data]);
    }

    public function ask_number()
    {
        $data = new AskModel();
        $data->mobile = request('ask_number');
        $data->save();
        echo 'success';
    }
}
