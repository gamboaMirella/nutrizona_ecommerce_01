@php
    $links = [
        [
            'icon' => 'fa-solid fa-house',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'icon' => 'fa-solid fa-layer-group',
            'name' => 'Categorías',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],

        [
            'icon' => 'fa-solid fa-list',
            'name' => 'Subcategorías',
            'route' => route('admin.subcategories.index'),
            'active' => request()->routeIs('admin.subcategories.*'),
        ],

        /* [
            'icon' => 'bi bi-box-fill',
            'name' => 'Productos',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ], */

        /* [
            'icon' => 'fa-solid fa-clipboard-list',  
            'name' => 'Pedidos',
            'route' => route('admin.pedidos.index'),
            'active' => request()->routeIs('admin.pedidos.*'),
        ], */
    ];
@endphp
<!--Se va a colocar un icono, nombre, ruta, verificar si se encuentra activo o no-->




<!--Cuando siderbarOpen este en True(en admin) lo que quiero que ocurra es que se agreguen las clases : 'translate-x-0 ease-put'
y cuando este en false: -translate-x-full ease-in}-->
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-put': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }} text-orange-400"></i>
                        </span>
                        <span class="ml-2 text-orange-400">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>