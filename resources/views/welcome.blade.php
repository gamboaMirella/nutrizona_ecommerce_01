<x-app-layout>

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush

    <!-- Slider main container -->
    <div class="swiper mb-12">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($covers as $cover)
              <div class="swiper-slide">
                <img src="{{ asset('storage/' . $cover->image_path )}}" class="w-full aspect-[3/1] object-cover object-center"/>
                {{-- <img src="{{ asset('storage\covers\nu1t8pz8bVT95FZI6m69bf933plqJBHsUQviyKJp.png') }}" class="w-full aspect-[3/1] object-cover object-center"/> --}}
              </div>
            @endforeach
            
             {{-- {{ dd(asset('storage/' . $cover->image_path))}} --}}

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

    <x-container class="">
      <h1 class="text-2xl font-bold text-gray-700 mb-4">
        Últimos productos
      </h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($lastProducts as $product)
            <article class="bg-white overflow-hidden shadow rounded">
              <img src="{{ 'storage/' . $product->image_path }}" class="w-full h-48 object-cover object-center">

              <div class="p-4">
                <h1 class="text-lg font-blod text-gray-700 line-clamp-2 min-h-[56px] mb-2">
                    {{ $product->name }}
                </h1>

                <p class="text-gray-600 mb-4">
                  S/. {{$product->price}}
                </p>

                <a href="{{route('products.show', $product)}}" class="btn btn-orange block w-full text-center">
                  Ver más
                </a>

              </div>


            </article>
        @endforeach
      </div>
    
    </x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                loop: true,

                autoplay: {
                    delay: 5000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

        </script>
    @endpush


</x-app-layout>
