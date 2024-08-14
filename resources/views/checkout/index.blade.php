<x-app-layout>

  <div class="-mb-16 text-gray-700" x-data="{
    pagos: 1,
  }">

    <div class="grid grid-cols-1 lg:grid-cols-2">

      <div class="col-span-1 bg-white">
        <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
          
          <h1 class="text-2xl font-semibold mb-2">
            Pago
          </h1>

          <div class="shadow rounded-lg overflow-hidden border border-gray-400 ">
            <ul class="divide-y divide-gray-300">

              {{-- radio superior --}}
              <li > 
                <label class="p-4 flex items-center">

                  <input type="radio" x-model="pagos" value="1" class="cursor-pointer">

                  <span class="ml-2">
                    Tarjeta de débito / crédito
                  </span>

                  <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png">

                </label>

                <div class="p-4 bg-orange-50 text-center border-t border-gray-400" 
                  x-show="pagos == 1">
                  <i class="fa-regular fa-credit-card text-9xl"></i>

                  <p class="mt-2">
                    Al hacer clic en "Pagar ahora" se te redirigirá a Niubiz para continuar tu compra de manera segura.  
                  </p>
                </div>

              </li>

              {{-- radio inferior --}}
              <li>
                <label class="p-4 flex items-center ">
                  <input type="radio" x-model="pagos" value="2" class="cursor-pointer">

                  <span class="ml-2">
                    Depósito Bancario o Yape
                  </span>

                </label>

                <div class="p-4 bg-orange-50 flex justify-center border-t border-gray-400" 
                  x-cloak  
                  x-show="pagos == 2">
                  
                  <div>

                    <p>1. Pago por depósito o transferencia bancaria:</p>
                    <p>- BCP soles: 158-987654321-87</p>
                    <p>- CCI: 002-158-987654321</p>
                    <p>- Razón social: NutrizonaUnt S.A.C</p>
                    <p>- RUC: 20987654321</p>
                    <p>2. Pago por Yape</p>
                    <p>- Yape:  (NutrizonaUnt S.A.C)</p>
                    <p>
                      Enviar el comprobante de pago a 961988445
                    </p>

                  </div>
                </div>

              </li>

            </ul>
          </div>

        </div>
        
      </div>

      <div class="col-span-1 bg-orange-50">
        <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
          
          <ul class="space-y-4 mb-4">

            @foreach (Cart::instance('shopping')->content() as $item)
                
            <li class="flex items-center space-x-4">

              <div class="flex-shrink-0 relative">
                <img class="h-16 aspect-square" src="{{ asset('storage/' . $item->options->image) }} " >

                  <div class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full
                      absolute -right-2 -top-2">

                      <span class="text-white font-semibold ">
                        {{$item->qty}}
                      </span>

                  </div>
              </div>

              <div class="flex-1">
                <p>
                  {{$item->name}}
                </p>

              </div>

              <div class="flex-shrink-0">
                <p>
                  S/. {{$item->price}}
                </p>
              </div>

            </li>

            @endforeach

          </ul>

          <div class="flex justify-between">
            <p>
              Subtotal
            </p>

            <p>
              S/. {{Cart::instance('shopping')->subtotal()}}
            </p>
          </div>

          <div class="flex justify-between">
            <p>
              Precio de envío

              <i class="fas fa-info-circle"
                title="El precio de envío es de S/. 5.00"></i>
            </p>

            <p>
              S/. 5.00
            </p>
          </div>

          <hr class="my-3">

          <div class="flex justify-between mb-4"> 
            <p class="font-semibold">
              Total
            </p>

            <p>
              S/. {{Cart::instance('shopping')->subtotal() + 5}}
            </p>
          </div>

          <div >
            <button onclick="VisanetCheckout.open()" class="btn btn-orange w-full ">
              Pagar ahora
            </button>

            @if (session('niubiz'))

              @php
                  $niubiz = session('niubiz');

                  $response = $niubiz['response'];
                  $purchaseNumber = $niubiz['purchaseNumber'];
              @endphp

              @isset($response['data'])
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 mt-8" role="alert">
                  
                  <p class="mb-4">
                    {{$response['data']['ACTION_DESCRIPTION']}}
                  </p>
                  
                  <p>
                    <b> Número de pedido: </b>
                    {{$purchaseNumber}}
                  </p>

                  <p>
                    <b> Fecha y hora del pedido: </b>
                    {{now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')}}
                  </p>

                  @isset($response['data']['CARD'])
                    <p>
                      <b> Tarjeta: </b>
                      {{$response['data']['CARD']}} ({{$response['data']['BRAND']}})
                    </p>
                  @endisset

                </div>
              @endisset

            @endif

          </div>

        </div>
        
      </div>

    </div>
    
  </div>

  @push('js')
    <script type="text/javascript" src="{{config('services.niubiz.url_js')}}"> </script>
    
    <script type="text/javascript">

      document.addEventListener('DOMContentLoaded', function() {

        let purchasenumber = Math.floor(Math.random() * 100000000);
        let amount = {{Cart::instance('shopping')->subtotal() + 5}};

        VisanetCheckout.configure({
          sessiontoken:'{{$session_token}}',
          channel:'web',
          merchantid:"{{config('services.niubiz.merchant_id')}}",
          purchasenumber:purchasenumber,
          amount: amount,
          expirationminutes:'20',
          timeouturl:'about:blank',
          merchantlogo:'storage/img/empresa.png',
          formbuttoncolor:'#ff6d05', //orange
          action:"{{ route('checkout.paid') }}?amount=" + amount + "&purchaseNumber=" + purchasenumber,
          complete: function(params) {
            alert(JSON.stringify(params));
          }
        });

      });

    </script>
  @endpush
</x-app-layout>