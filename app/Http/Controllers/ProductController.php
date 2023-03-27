<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::all();
        return view('list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('welcome',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = isset($request->product_name) ? $request->product_name : ''; 
        $product->category_id = isset($request->category) ?  $request->category : '';   
        $product->price = isset($request->price) ? $request->price : ''; 
        $image = $request->file('file');
        if($image){
            $new_name = $image->getClientOriginalName();
            $image->move(public_path('images'), $new_name);
            $product->image = $new_name;
        }
        $product->save();
        return redirect('product')->with('message', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $userObj = Product::where('id',$id)->first();
        $userObj->product_name = isset($request->product_name) ? $request->product_name : $userObj->product_name;      
        $userObj->category_id = isset($request->category) ?  $request->category : $userObj->category_id;
        $userObj->price = isset($request->price) ? $request->price : $userObj->price;
        $image = $request->file('file');
        if($image){
            $new_name = $image->getClientOriginalName();
            $image->move(public_path('images'), $new_name);
            $userObj->image = $new_name;
        }
        $userObj->update();
        if ($userObj) {
            return redirect('product')->with('message', 'Product Updated successfully');
        } else {
            return redirect('product')->with('message', 'Failed to update product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
  
        return response()->json(['success'=>'User Deleted Successfully!']);
    }
    public function getProducts($id)
    {
        $product = Product::all();

        $html = '';
        $html .= '<div id="inputFormRow">';
       
    $html .='<label>Product Name</label>';
    $html .='<select id="product" name="more['.$id.'][product]">';
    $html .='<option value="" disabled selected>Select Product</option>';
      if($product->count() > 0){
      foreach($product as $pro){
        $html .='<option value="'.$pro->id.'">'.$pro->product_name.'</option>';
      }
    }
    $html .='</select>';
    $html .='<input type="text" name="more['.$id.'][quantity]" id="quantity" class="form-control" placeholder="Enter quantity">';
    $html .='<div class="input-group-append">';
    $html .='<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
    $html .='</div>';
    $html .= '</div>';
    echo $html;

    }
}
