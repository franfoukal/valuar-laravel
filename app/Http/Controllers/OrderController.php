<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Andreani\Andreani;
use Andreani\Requests\CotizarEnvio;

// // SDK de Mercado Pago
// use MercadoPago;
// // Agrega credenciales
// MercadoPago\SDK::setAccessToken(env('MERCADOLIBRE_ACCESS_TOKEN'));


/*
*
* Trabajo en progreso.
*
* Zona de escombros.
*
* Peligro zanja abierta.
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
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    //
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
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

        return $order;
    }

    public function cotizarEnvio(Request $req){
        // Los siguientes datos son de prueba, para la implementación en un entorno productivo deberán reemplazarse por los verdaderos
        $request = new CotizarEnvio();
        $request->setCodigoDeCliente(env('ANDREANI_CLIENT'));
        $request->setNumeroDeContrato(env('ANDREANI_STANDART_SHIPPING_CODE'));
        $request->setCodigoPostal($req->postal_code);
        $request->setPeso($req->weight);
        $request->setVolumen($req->volume);
        $request->setValorDeclarado($req->value);

        $andreani = new Andreani('eCommerce_Integra','passw0rd','test');
        $response = $andreani->call($request);
        if($response->isValid()){
        $tarifa = $response->getMessage()->CotizarEnvioResult->Tarifa;
        return response()->json([
        "tarifa" => $tarifa
        ], 200);
        } else {
        return response()->json([
        "error" => $response->getMessage()
        ], 400);
        }
    }

    // public function createOrderML(Request $request){
    //     $allowedPaymentMethods = config('payment-methods.enabled');

    //     $request->validate([
    //         'payment_method' => [
    //             'required',
    //             Rule::in($allowedPaymentMethods),
    //         ],
    //         'terms' => 'accepted',
    //     ]);

    //     $order = $this->createOrder($request);

    //     $this->notify($order);
    //     $url = $this->generatePaymentGateway($request->get('payment_method'), $order);
    //     return redirect()->to($url);
    // }

    // protected function generatePaymentGateway($paymentMethod, Order $order): string
    // {
    //     $method = new \App\PaymentMethods\MercadoPago;

    //     return $method->setupPaymentAndGetRedirectURL($order);
    // }

}