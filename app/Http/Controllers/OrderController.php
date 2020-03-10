<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

/*
*   
*   Trabajo en progreso.
*   
*   Zona de escombros. 
*   
*   Peligro zanja abierta.
*/


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createOrder(Request $request){

        $order = new Order();

        $order->subtotal = $request['subtotal'];
        $order->tax_percentage = $request['tax_percentage'];
        $order->interest_percentage = $request['interest_percentage'];
        $order->receipt_type = $request['receipt_type'];
        $order->receipt_number = $request['receipt_number'];
        $order->active = $request['active'];
        $order->users_id = Auth::User()->id;
        $order->status_id = $request['status_id'];
        $order->shippings_id = $request['shippings_id'];
        
        $order->save();
    }
}
