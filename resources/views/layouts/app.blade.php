<!DOCTYPE html> <!--ESTA PLANTILLA SE CREA AL INICIAR SESIÓN-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @stack('css')

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/d7df4e9598.js" crossorigin="anonymous"></script>

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu') --}}

        @livewire('navigation')



        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <div class="mt-16">
            @include('layouts.partials.app.footer')
        </div>
    </div>

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--Para hacer alertas-->
    
    @livewireScripts

    @stack('js')

    @if (session('swal')) <!--Escuchar eventos de la variable de sesión-->
        <script>
            Swal.fire({!! json_encode(session('swal')) !!}); /**json_encode: Transformar php en javascript*/
        </script>
    @endif

    <!--Escuchar los eventos de se emitan en livewire-->
    <script> 
        Livewire.on('swal', data => {
            Swal.fire(data[0]);
        })
    </script>


</body>

</html>
