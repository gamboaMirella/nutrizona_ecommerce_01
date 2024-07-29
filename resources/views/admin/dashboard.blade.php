<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
    ]
]"> 


    <!--El contenido que incluya aquí se vera en la parte blanca del dashboard-->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6"> <!--OPCIONAL: DOS TARJETAS PARA DASHBOARD-->
        <div class="bd-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />

                <div class="ml-4 flex-1">
                    <h2 class="text-lg fond-semibold">
                        Bienvenido, {{ auth()->user()->name }}
                    </h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-sm hover:text-orange-400">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bd-white rounded-lg shadow-lg p-6 flex items justify-center">
            <h2 class="text-xl fond-semibold">
                Nutrizona
            </h2>
        </div>
    </div>



</x-admin-layout>
