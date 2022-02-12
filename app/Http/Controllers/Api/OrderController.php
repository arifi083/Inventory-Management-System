<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function TodayOrder(){
     
        $data = date('d/m/Y');
        $order = DB::table('orders')
           ->join('customers','orders.customer_id','customers.id')
           ->where('order_date',$data)
           ->select('customers.name','orders.*')
           ->orderBy('orders.id','DESC')->get();
           return response()->json($order); 
    }

    public function OrderDetails($id){
        //return response()->json($id);
        $order = DB::table('orders')
          ->join('customers','orders.customer_id','customers.id')
          ->where('orders.id',$id)
          ->select('customers.name','customers.phone','customers.address','orders.*')
          ->first();
          return response()->json($order);
 
    }
 
 
    public function OrderDetailsAll($id){
 
            $details = DB::table('orderdetails')
                ->join('products','orderdetails.product_id','products.id')
                ->where('orderdetails.order_id',$id)
                ->select('products.product_name','products.product_code','products.image','orderdetails.*')
                ->get();
                return response()->json($details);
 
 
    }
}
