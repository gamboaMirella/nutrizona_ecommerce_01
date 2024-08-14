<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ],
]">

    <x-slot name="action"> <!--BOTON DE AGREGAR PRODUCTO-->
        <a class="btn btn-orange" href="{{ route('admin.products.create') }}">
            Crear
        </a>
    </x-slot>

    @if ($products->count())
        <!--TABLA PARA MOSTRAR CATEGORIAS-->
        <div class="relative overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-black uppercase bg-orange-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Código
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                        <tr class="bg-gray-100 border-b">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->sku }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->price }}
                            </td>

                            <td >
                                <div class="flex justify-start">

                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                    class="flex flex-col items-center hover:text-orange-600 px-2">
                                        <i class="fa-solid fa-pen-to-square text-xm"></i> <!-- Ícono  -->
                                        <span class="text-xs">Editar</span> <!-- Texto naranja -->
                                    </a>

                                    {{-- Agregar más iconos --}}
                                    
                                </div>
                                    
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!--FIN DE TABLA PARA MOSTRAR CATEGORIAS-->

        <!--LINKS DE PAGINACION-->
        @if($products->hasPages())
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @endif
        <!--FIN LINKS DE PAGINACION-->
    @else
        <!--ALERTA DE PRODUCTOS-->
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Alerta!</span> Todavía no hay productos registrados.
            </div>
        </div>
        <!--FIN DE ALERTA DE CATEGORIAS-->


    @endif


</x-admin-layout>
