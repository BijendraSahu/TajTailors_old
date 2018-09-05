<?php

namespace App\Http\Controllers;

use App\StateModel;
use Illuminate\Http\Request;
session_start();
class StateController extends Controller
{
 public function statelist()
 {
     $statedata = StateModel::get();
     return view('adminview.state',['statedata'=>$statedata]);
 }
 public function add_state()
 {
     $data = new StateModel();
     $data->state_name = request('state');
     $data->save();
     return '1';
 }

 public function update_state()
 {
    $myid=request('up_id');
     $state=request('state');

     {
         $data = array(
             'state_name' => request('state'),
         );
         StateModel::where('id', request('up_id'))
             ->update($data);
         return 'Successfully Added';
     }

 }
 public function delete_state()
 {
     {
         $data = array(
             'is_deleted' => '1',
         );
         StateModel::where('id', request('mydid'))
             ->update($data);
         return 'Successfully Added';
     }

 }
}
