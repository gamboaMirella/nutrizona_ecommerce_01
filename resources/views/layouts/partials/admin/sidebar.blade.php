@php
    $links = [
        [
            'icon' => 'fa-solid fa-house',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Administrar página',
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

        [
            'icon' => 'bi bi-box-fill',
            'name' => 'Productos',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ], 

        [
            'icon' => 'fa-solid fa-images',  
            'name' => 'Portadas',
            'route' => route('admin.covers.index'),
            'active' => request()->routeIs('admin.covers.*'),
        ],
        [
            'header' => 'órdenes y envíos',
        ],
        [
            'name' => 'Órdenes', 
            'icon' => 'fa-solid fa-shopping-cart',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*'),
        ],
        [
            'name' => 'Usuarios', 
            'icon' => 'fa-solid fa-users',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
    ];
@endphp
<!--Se va a colocar un icono, nombre, ruta, verificar si se encuentra activo o no-->




<!--Cuando siderbarOpen este en True(en admin) lo que quiero que ocurra es que se agreguen las clases : 'translate-x-0 ease-put'
y cuando este en false: -translate-x-full ease-in}-->
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-orange-500 border-r border-gray-200 sm:translate-x-0"
    :class="{
        'translate-x-0 ease-put': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-orange-500">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="px-3 py-2 text-xs font-semibold text-white opacity-90 uppercase">
                            {{$link['header']}}
                        </div>
                    @else

                        <a href="{{ $link['route'] }}"
                            class="flex items-center p-2 text-white rounded-lg  hover:bg-orange-700 group {{ $link['active'] ? 'bg-orange-700' : '' }}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }} text-white"></i>
                            </span>
                            <span class="ml-2 text-white">{{ $link['name'] }}</span>
                        </a>
                    
                    @endisset
                </li>
            @endforeach

        </ul>
    </div>
</aside>
