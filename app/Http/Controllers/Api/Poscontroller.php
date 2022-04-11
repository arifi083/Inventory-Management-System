<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;

class Poscontroller extends Controller
{
    public function getProducts($id){
        $product = DB::table('products')->where('category_id',$id)->get();
        return response()->json($product);
    }


    public function OrderDone(Request $request){

   	 $validatedData = $request->validate([
      'customer_id' => 'required',
   	 ]);
   
    $data = array();
    $data['customer_id'] = $request->customer_id;
    $data['qty'] = $request->qty;
    $data['sub_total'] = $request->subtotal;
    $data['vat'] = $request->vat;
    $data['total'] = $request->total;
    $data['pay'] = $request->pay;
    $data['due'] = $request->due;
    $data['payby'] = $request->payby;
    $data['order_date'] = date('d/m/Y');
    $data['order_month'] = date('F');
    $data['order_year'] = date('Y');
    $order_id = DB::table('orders')->insertGetId($data);

    $contents = DB::table('pos')->get();

    $odata = array();
    foreach ($contents as $content) {
    $odata['order_id'] = $order_id;
    $odata['product_id'] = $content->pro_id;
    $odata['pro_quantity'] = $content->pro_quantity;
    $odata['product_price'] = $content->product_price;
    $odata['sub_total'] = $content->sub_total;
    DB::table('orderdetails')->insert($odata); 

       
        DB::table('products')
        	->where('id',$content->pro_id)
        	->update(['product_quantity' => DB::raw('product_quantity -' .$content->pro_quantity)]);

    }
    DB::table('pos')->delete();
    return response('Done'); 

   }

   public function SearchOrderDate(Request $request){ 
    $order_start = $request->start_date;
    $order_end = $request->end_date;

    $order_date_start = new DateTime($order_start);
    $start_done = $order_date_start->format('d/m/Y'); 

    $order_date_end = new DateTime($order_end);
    $start_end = $order_date_end->format('d/m/Y'); 

    $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->select('customers.name','orders.*')
            //->whereBetween('orders.order_date',[$start_done, $start_end])
            ->whereDate('orders.order_date',$start_done)
            ->whereDate('orders.order_date',$start_end)
            ->get();
    return response()->json($order);

   }

   public function TodaySell(){
    $date = date('d/m/Y');
    //return response()->json($date);
    $sell = DB::table('orders')->where('order_date',$date)->sum('total');
    return response()->json($sell);
   }

   public function TodayIncome(){
    $date = date('d/m/Y');
    $income = DB::table('orders')->where('order_date',$date)->sum('pay');
    return response()->json($income);

   }

   public function TodayDue(){
     $date = date('d/m/Y');
     $due = DB::table('orders')->where('order_date',$date)->sum('due');
     return response()->json($due);

   }

   public function TodayExpense(){
    $date = date('d/m/Y');
    $expense = DB::table('expenses')->where('date',$date)->sum('amount');
    return response()->json($expense);
   }


   public function StockOut(){
       $product = DB::table('products')->where('product_quantity','<','1')->get();
       return response()->json($product);
   }


   public function SearchOrderMonth(Request $request){
       $month = $request->month;
      $order = DB::table('orders')
        ->join('customers','orders.customer_id','customers.id')
        ->select('customers.name','orders.*')
         ->where('orders.order_month',$month)
        ->get();
        return response()->json($order);
     
    }


    public function SearchOrderYear(Request $request){
        $year = $request->year;
       $order = DB::table('orders')
         ->join('customers','orders.customer_id','customers.id')
         ->select('customers.name','orders.*')
          ->where('orders.order_year',$year)
         ->get();
         return response()->json($order);
      
     }



 
}
