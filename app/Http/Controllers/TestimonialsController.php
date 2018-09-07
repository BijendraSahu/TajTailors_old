<?php

namespace App\Http\Controllers;

use App\Testimonials;
use Illuminate\Http\Request;

session_start();

class TestimonialsController extends Controller
{
    public function list()
    {
        return view('adminview.testimonials');
    }


    public function addtstimonials()
    {
        $data = new Testimonials();
        $data->user_id = request('user');
        $data->review = request('review');
        $data->save();
        return 'done';
    }

    public function inactivetest()
    {
        try {
            $data = array(
                'is_active' => '0'
            );
            Testimonials::where('id', request('myid'))
                ->update($data);
            return request('myid');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function activetest()
    {
        try {
            $data = array(
                'is_active' => '1'
            );
            Testimonials::where('id', request('myid'))
                ->update($data);
            return request('myid');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function deletetest()
    {
        Testimonials::where('id', request('myy'))->delete();
        return '1';

    }
}
