<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SuperAdminController extends Controller
{

    public function index()
    {
    	$this->AdminAuthCheck();

    	return view('admin.dashboard');


    }


    public function logout()
    {


    	Session::flush();
    	return Redirect::to('/admin'); 
    }

    public function AdminAuthCheck()
    {

    	$admin_id=Session::get('admin_id');

    	if ($admin_id) {
    		
    		return;
    	}else{

    		return Redirect::to('/admin')->send();
    	}

    }


    public function unactive_order($order_id)
    {

         DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status'=>'success']);
        Session::put('message','Product Delivery Successfully !!');
            return Redirect::to('/manage-order');
    }

    public function delete_order($order_id)
     {

        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->delete();
        Session::get('message','Order Deleted Successfully !');
        return Redirect::to('/manage-order');
     }

     
}
