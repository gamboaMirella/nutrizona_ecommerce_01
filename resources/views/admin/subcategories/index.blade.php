<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
    ],
]">

    <x-slot name="action"> <!--BOTON DE AGREGAR SUBCATEGORIA-->
        <a class="btn btn-orange" href="{{ route('admin.subcategories.create') }}">
            Crear
        </a>
    </x-slot>

    @if ($subcategories->count())
        <!--TABLA PARA MOSTRAR CATEGORIAS-->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoría
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($subcategories as $subcategory)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $subcategory->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $subcategory->name }}
                            </td>
                            <td class="px-6 py-4">
                              {{ $subcategory->category->name }}
                          </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.subcategories.edit', $subcategory) }}">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!--FIN DE TABLA PARA MOSTRAR CATEGORIAS-->

        <!--LINKS DE PAGINACION-->
        <div class="mt-4">
            {{ $subcategories->links() }}
        </div>
        <!--FIN LINKS DE PAGINACION-->
    @else
        <!--ALERTA DE CATEGORIAS-->
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Alerta!</span> Todavía no hay subcategorías registradas.
            </div>
        </div>
        <!--FIN DE ALERTA DE CATEGORIAS-->


    @endif



</x-admin-layout>
