<?php

namespace App\Http\Controllers;

use App\ReviewModel;
use Illuminate\Http\Request;
session_start();

class ReviewController extends Controller
{
public function review()
{
    $review_data=ReviewModel::get();
    return view('adminview.review',['review_data'=>$review_data]);
}
public function activate_review()
{

    $data = array(
        'is_approved' => 1,
    );
    ReviewModel::where('id', request('IDD'))
        ->update($data);
    return '1';

}
public function un_activate_review()
{

    $data = array(
        'is_approved' => 0,
    );
    ReviewModel::where('id', request('IDD'))
        ->update($data);
    return '1';

}
}
