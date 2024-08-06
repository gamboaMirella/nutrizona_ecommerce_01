<x-app-layout>

    <div class="w-full max-w-3xl mx-auto pt-12">
        <img 
            src="https://img.demarco.cdn.ftsdn.com/PUUmkyePhtmzM-6_LIvBq_8ayB7Pr1iX0RdWShWf6KE/resize:fill:1000:330:0/gravity:sm/aHR0cHM6Ly93d3cuZGVtYXJjby5jb20udXkvd3AtY29udGVudC91cGxvYWRzLzIwMjAvMDkvVE9ETy1KVU5UTy0yLmdpZg"
        >

        @if (session('niubiz'))
            @php

                $response = session('niubiz')['response'];

            @endphp

            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 mt-8"
                role="alert">
                
                <p class="mb-4">
                  {{$response['dataMap']['ACTION_DESCRIPTION']}}
                </p>

                <p>
                    <b> Número de pedido: </b>
                    {{$response['order']['purchaseNumber']}}
                </p>

                <p>
                    <b> Fecha y hora del pedido: </b>
                    {{now()->createFromFormat('ymdHis', $response['dataMap']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')}}
                </p>

                <p>
                    <b> Tarjeta: </b>
                    {{$response['dataMap']['CARD']}} ({{$response['dataMap']['BRAND']}})
                </p>

                <p>
                    <b> Importe: </b>
                    {{$response['order']['amount']}} ({{$response['order']['currency']}})
                </p>

            </div>
        @endif

    </div>


</x-app-layout>
