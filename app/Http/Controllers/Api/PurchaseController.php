<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use DB;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = DB::table('purchases')
        ->join('products','purchases.product_id','products.id')
        ->join('suppliers','purchases.supplier_id','suppliers.id')
        ->select('purchases.*','products.product_name','products.image','suppliers.name')
        ->orderBy('purchases.id','DESC') 
        ->get();
        return response()->json($purchase);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'total_cost' => 'required',
        ]);
   
        $purchase = new Purchase;
        $purchase->product_id = $request->product_id;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->quantity = $request->quantity;
        $purchase->total_cost = $request->total_cost;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = DB::table('purchases')->where('id',$id)->first();
        return response()->json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['quantity'] = $request->quantity;
        $data['total_cost'] = $request->total_cost;
        DB::table('purchases')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('purchases')->where('id',$id)->delete();
    }
}
