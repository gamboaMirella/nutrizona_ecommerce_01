<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2" aria-label="Encabezado del carrito de compras">

                <h1 class="text-lg">
                    Carrito de compras ({{Cart::count()}} productos) 
                </h1>

                <button class="font-semibold text-gray-600 hover:text-orange-500 underline hover:no-under"
                    wire:click="destroy()" aria-label="Limpiar carrito">
                    Limpiar carro
                </button>
    
            </div>

            <div class="card" aria-label="Lista de productos en el carrito">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        
                        <li class="lg:flex" aria-labelledby="product-{{ $item->rowId }}">
                            <img class="w-full lg:w-36 aspect-[16/9] object-cover object-center mr-2 " src="{{'storage/' . $item->options->image}}" alt="Imagen del producto">
                            
                            <div class="w-80">
                                <p id="product-{{ $item->rowId }}" class="text-sm">
                                    <a href="{{route('products.show', $item->id)}}">
                                        {{$item->name}}
                                    </a>
                                </p>

                                <button class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5"
                                    wire:click="remove('{{$item->rowId}}')" aria-label="Quitar {{ $item->name }} del carrito">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>

                            <p>
                                S/. {{$item->price}}
                            </p>

                            <div class="ml-auto space-x-2" aria-label="Modificar cantidad del producto {{ $item->name }}">
                                <button class="btn btn-gray" 
                                    wire:click="decrease('{{$item->rowId}}')" aria-label="Disminuir cantidad de {{ $item->name }}">
                                 -
                                </button>
                
                                <span class="inline-block w-2 text-center"> 
                                    {{$item->qty}}
                                </span>
                    
                                <button class="btn btn-gray"
                                    wire:click="increase('{{$item->rowId}}')" aria-label="Aumentar cantidad de {{ $item->name }}">  
                                    +
                                </button>
                            </div>
                            
                        </li>
                    @empty
                        <p class="text-center"> 
                            No hay productos en el carrito 
                        </p>
                    @endforelse
                </ul>
            </div>
            
        </div>

        <div class="lg:col-span-2" aria-label="Resumen de la compra">

            <div class="card">

                <div class="flex justify-between font-semibold mb-2" aria-label="Total de la compra">
                    <p>
                        Total:
                    </p>

                    <p>
                       S/. {{Cart::subtotal()}}
                    </p>

                </div>

                <a href="{{route('shipping.index')}}" class="btn btn-orange block w-full text-center" aria-label="Continuar con la compra">
                    Continuar compra
                </a>

                <div class="mt-2">
                    <img class="h-6 mr-auto" src="https://codersfree.com/img/payments/credit-cards.png" alt="Métodos de pago">
                </div>
            </div>

        </div>
        {{-- @dump($item) --}}
    </div>
</div>
