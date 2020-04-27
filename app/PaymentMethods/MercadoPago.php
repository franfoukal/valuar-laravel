<?php

namespace App\PaymentMethods;

use App\Order;
use App\User;
use Exception;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPago
{
    public function __construct()
    {
        SDK::setClientId(
            config("payment-methods.mercadopago.client")
        );
        SDK::setClientSecret(
            config("payment-methods.mercadopago.secret")
        );
        SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

    }


    public function setupPaymentAndGetRedirectURL2(Order $order): string
    {
        $order = json_decode($order);
        $order->product_list = json_decode($order->product_list);
        $order->billing_info = json_decode($order->billing_info);
        
        try {
            //code...
            # Create a preference object
            $preference = new Preference();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
        # Create an item object
        $item = new Item();
        $item->id = $order->id;
        $item->title = "Orden de compra $order->id";
        $item->quantity = 1;
        $item->currency_id = 'ARS';
        $item->unit_price = $order->billing_info->total;
        // $item->picture_url = $order->featured_img;

        # Create a payer object
        $payer = new Payer();
        $payer->email = User::findOrFail($order->user_id)->email;

        # Setting preference properties
        $preference->items = array($item);
        $preference->payer = $payer;

        # Save External Reference
        $preference->external_reference = $order->id;
        $preference->back_urls = [
            "success" => route('order'),
            "pending" => route('order'),
            "failure" => route('order'),
        ];

        $preference->auto_return = "all";
        //$preference->notification_url = route('order'); //route('ipn');
        # Save and POST preference
        $preference->save();


        if (config('payment-methods.use_sandbox')) {
            return $preference->sandbox_init_point;
        }

        return $preference->init_point;
    }

}
