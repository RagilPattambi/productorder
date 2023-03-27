<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Http\Request;
use \PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        return view('order/list', compact('order'));
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
        $userObj = new Order();     
        $userObj->customer_name = isset($request->customer_name) ?  $request->customer_name : '';
        $userObj->phone_number = isset($request->phone) ? $request->phone : '';
        $userObj->save();
        $lastId = $userObj->id;
        $products = $request->more;
        if($products){
            foreach($products as $pro){
                $invoice = new Invoice;
                $invoice->order_id = $lastId;
                $invoice->product_id = $pro['product'];
                $invoice->quantity = $pro['quantity'];
                $price = Product::select('price')->where('id',$pro['product'])->get();  
                $invoice->total_price = $pro['quantity'] * ($price[0]->price);
                $invoice->save();
            }
        }


        // \Session::flash('success', 'Product Details added successfully.');
        // return redirect('/list-order');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function generatePdf($id)
    {
    $select = array('invoices.order_id','products.product_name','invoices.quantity','invoices.total_price');
    $invoice =Order::select($select)->join('invoices', 'invoices.order_id', '=', 'orders.id')
    ->join('products', 'products.id', '=', 'invoices.product_id')
    ->where('orders.id',$id)->get()->toArray();
        $pdf = PDF::loadView('order/invoice', compact('invoice'));
        return $pdf->stream('Invoice.pdf');
    }
}
