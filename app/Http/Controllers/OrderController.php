<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Andreani\Andreani;
use Andreani\Requests\CotizarEnvio;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;



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
        $order->shipping_info = $request->shipping_info;
        $order->billing_info = $request->billing_info;
        $order->product_list = $request->product_list;
        $order->user_id = Auth::user()->id;
        $order->preorder_id = $this->generatePreorderID();
        $request->session()->forget('pre-order');
        $request->session()->put('pre-order', $order);

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

    public function createOrderML(Request $request){
        $allowedPaymentMethods = config('payment-methods.enabled');

        $request->validate([
            'payment_method' => [
                'required',
                Rule::in($allowedPaymentMethods),
            ],
            // 'terms' => 'accepted',
        ]);

        $order = $this->createOrder($request);

        // $this->notify($order);
        $url = $this->generatePaymentGateway($request->get('payment_method'), $order);
        return $url;
    }

    protected function generatePaymentGateway($paymentMethod, Order $order): string
    {
        $method = new \App\PaymentMethods\MercadoPago;

        return $method->setupPaymentAndGetRedirectURL($order);
    }


    public function getPaymentResponse(Request $request){
        $querys = $request->all();

        // $order = Order::findOrFail($request->external_reference);
        $order = $request->session()->pull('pre-order');
        $order->mercadopago_info = json_encode($querys);

        switch ($querys['collection_status']) {
            case 'in_process':
                $request->session()->forget('cart');
                $order->save();
                return view('payment.pending');
                break;
            case 'approved':
                $request->session()->forget('cart');
                $order->save();
                return view('payment.success');
                break;
            case 'rejected':
                return view('payment.rejected');
                break;
            default:
                # code...
                break;
        }
    }

    public function getUserOrders(){
        $orders = Order::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'orders' => json_encode($orders)
        ],200);
    }

    private function generatePreorderID(){
        $temp = Str::random(10);
        while (Order::where('preorder_id', '=', $temp)->exists()) {
            $temp = Str::random(10);
        }

        return $temp;
    }

}