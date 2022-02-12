<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('products.*','categories.category_name','suppliers.name')
        ->orderBy('products.id','DESC')
        ->get();
        return response()->json($product);
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
            'product_name' => 'required|max:355',
            'product_code' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);


        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
   
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image = $image_url;  
            $product->save(); 
        }
        else{

            $product = new Product;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity; 
            $product->save(); 
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        return response()->json($product);
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
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['root'] = $request->root;

        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;

        $image = $request->newimage;

        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);

            if($success){
                $data['image'] = $image_url;
                $img = DB::table('products')->where('id',$id)->first();
                $img_path = $img->image;
                unlink($img_path);
                DB::table('products')->where('id',$id)->update($data);

            }

        }
        else{
            $oldimage = $request->image;
            $data['image'] = $oldimage;
            DB::table('products')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $image = $product->image;
        if($image){
           unlink($image);
           DB::table('products')->where('id',$id)->delete();
        }
        else{
            DB::table('products')->where('id',$id)->delete();
        }
    }


    public function StockUpdate(Request $request, $id){
        $data = array();
        $data['product_quantity'] = $request->product_quantity;
        DB::table('products')->where('id',$id)->update($data);

    }




}
