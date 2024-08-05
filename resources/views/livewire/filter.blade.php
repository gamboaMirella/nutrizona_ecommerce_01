<div class="bg-white py-12">
    <x-container class="px-4 md:flex">

        <div class="flex-1">

            

            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:

                    <x-select wire:model.live="orderBy">
                        <option value="1">
                            Relevancia
                        </option>

                        <option value="2">
                            Precio: menor a mayor
                        </option>

                        <option value="3">
                            Precio: mayor a menor
                        </option>
                    </x-select>
                </span>
            </div>

            <hr class="my-4">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <article class="bg-white overflow-hidden shadow rounded">
                        <img src="{{ $product->image_path }}" class="w-full h-48 object-cover object-center">

                        <div class="p-4">
                            <h1 class="text-lg font-blod text-gray-700 line-clamp-2 min-h-[56px] mb-2">
                                {{ $product->name }}
                            </h1>

                            <p class="text-gray-600 mb-4">
                                S/ {{ $product->price }}
                            </p>

                            <a href="{{route('products.show', $product)}}" class="btn btn-orange block w-full text-center">
                                Ver más
                            </a>



                        </div>


                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>
    </x-container>

</div>
