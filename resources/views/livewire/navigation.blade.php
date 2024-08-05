<div x-data="{
    open: false,
}">
    <header class="bg-orange-500">
        <x-container class="px-4 py-4">
            <div class="flex items-center space-x-8 justify-between">
                <button class="text-xl md:text-3xl" x-on:click="open = true">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-xl md:text-3xl leading-4 md:leading-6 font-semibold">
                            Nutrizona
                        </span>

                        <span class="text-xs">
                            Tienda online
                        </span>
                    </a>
                </h1>

                <div class="flex-1 hidden md:block">
                    <x-input oninput="search(this.value)" class="w-full" placeholder="¿Qué se le antoja hoy?">
                    </x-input>
                </div>

                <div class="flex items-center space-x-8 md:space-x-8">

                    <x-dropdown>
                        <x-slot name="trigger">

                            @auth
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="text-xl md:text-3xl">
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            @endauth
                        </x-slot>

                        <x-slot name="content">
                            @guest
                                <div class="px-4 py-2">

                                    <div class="flex justify-center">
                                        <a href="{{ route('login') }}" class="btn btn-orange">
                                            Iniciar sesión
                                        </a>
                                    </div>

                                    <p class="text-sm text-center mt-2">
                                        ¿Aún no tienes cuenta? <a href="{{ route('register') }}"
                                            class="text-orange-500 hover:underline">Registrate</a>
                                    </p>

                                </div>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    Mi perfil
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>


                            @endguest

                        </x-slot>
                    </x-dropdown>



                    <a href="{{route('cart.index')}}" class="relative">
                        <i class="fas fa-shopping-cart text-white text-xl md:text-3xl"></i>
                        <span id="cart-count"
                            class="absolute -top-2 -end-4 inline-flex 
                            items-center justify-center w-6 h-6 
                            bg-red-800 rounded-full text-xs font-bold text-white
                            border-2 border-white">
                            
                            {{Cart::instance('shopping')->count()}}
                        </span>
                    </a>
                </div>
            </div>


            <div class="mt-4 md:hidden">
                <x-input oninput="search(this.value)" class="w-full" placeholder="¿Qué se le antoja hoy?" />
            </div>
        </x-container>


    </header>

    <div x-show="open" x-on:click="open = false" style="display: none"
        class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"></div>

    <!-- MENU-->
    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20">
        <div class="flex">
            <div class="w-80 h-screen bg-white">
                <div class="bg-orange-500 px-4 py-3 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            Bienvenido
                        </span>

                        <button x-on:click="open = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>


                <div class="h-[calc(100vh - 52px)] overflow-auto">
                    <ul>
                        @foreach ($categories as $category)
                            <li wire:mouseover="$set('category_id', {{ $category->id }})">
                                <a href="{{ route('categories.show', $category) }}"
                                    class="flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-orange-200">
                                    {{ $category->name }}

                                    <i class="fa solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="w-80 xl:w-[57rem] pt-[52px]">
                <div class="bg-white h-[calc(100vh - 52px)] overflow-auto px-6 py-8">

                    <div class="mb-8 flex justify-between items-center">
                        <p class="border-b-[3px] border-blue-900 uppercase text-xl font-semibold pb-1">
                            {{ $this->categoryName }}
                        </p>

                        <a href="{{ route('categories.show', $category_id) }}" class="btn btn-blue">
                            Ver todo
                        </a>
                    </div>
                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach ($this->subcategories as $subcategory)
                            <li>
                                <a href="{{route('subcategories.show', $subcategory)}}" class="text-gray-700 font-semibold text-lg hover:text-orange-500">
                                    {{ $subcategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('js')


        <script>

            Livewire.on('cartUpdated', (count) => {
                document.getElementById('cart-count').innerText = count;
            })

            function search(value) {
                Livewire.dispatch('search', {
                    search: value
                })
            }
        </script>

    @endpush

</div>
