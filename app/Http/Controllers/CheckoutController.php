<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Query\IndexHint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LaravelLang\Publisher\Console\Add;

class CheckoutController extends Controller
{
    public function index() {
        $access_token = $this->generateAccessToken();
        // dd($access_token);
        $session_token = $this->generateSessionToken($access_token);
        // return $session_token;
        return view('checkout.index', compact('session_token'));
    }

    public function generateAccessToken() {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        
        $auth = base64_encode($user.':'.$password);

        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth
        ])
            ->get($url_api)
            ->body();
    }

    public function generateSessionToken($access_token) {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json ',
        ])
        ->post($url_api, [
            'channel' => 'web',
            'amount' => Cart::instance('shopping')->subtotal() + 5,
            'antifraud' => [
                'client_ip' => request()->ip(),
                'merchantDefineData' => [
                    'MDD15' => 'value15',
                    'MDD20' => 'value20',
                    'MDD33' => 'value33',
                ],
            ],
        ])
        ->json();

        return $response['sessionKey'];
    }

    public function paid(Request $request) {
        // return $request->all();
        $merchant_id = config('services.niubiz.merchant_id');
        $access_token = $this->generateAccessToken();
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json ',
        ])->post($url_api, [
            'channel' => 'web',
            'captureType' => 'manual',
            'countable' => true,
            'order' => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchaseNumber,
                "amount" => $request->amount,
                "currency" => "PEN",
            ] 
        ])->json();

        // return $response;  //para ver los campos de la respuesta
        
        session()->flash('niubiz', [
            'response' => $response,
            "purchaseNumber" => $request->purchaseNumber,
        ]);

        if(isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            
            $address = Address::where('user_id', auth()->id())
                ->where('default', true)
                ->first();
            //se guarda la orden en la BD
            Order::create([
                'user_id' => auth()->id(),
                'content' => Cart::instance('shopping')->content(),
                'address' => $address->description, //verificar campo correcto 
                'transaction_id' => $response['dataMap']['TRANSACTION_ID'],
                'total' => Cart::subtotal(),
            ]);

            Cart::instance('shopping')->destroy();

            return redirect()->route('gracias');
        }

        return redirect()->route('checkout.index'); //si es que no se produce la compra o hay error
    }
}

// Datos de prueba para compras con tarjeta en pasarela niubiz
// Escenario	            Número	            Mes/año	    CVV	    Código de Acción

// Venta exitosa –          4474118355632240	03/2028	    111	    000
// sin cuotas


// Operación no permitida   4916122919724598    03/2028	    111	    102
// para esta tarjeta

// Error en autenticación	4732453453776393	03/2028	    111	    678