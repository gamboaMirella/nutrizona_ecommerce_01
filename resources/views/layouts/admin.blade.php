@props(['breadcrumbs' => []]) <!--Si no se envia nada el valor será vacio-->

<!DOCTYPE html> <!--ESTA PLANTILLA SE CREA AL INICIAR SESIÓN-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--Se asigna el idioma de la aplicacion(e)-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/d7df4e9598.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>


<!-- x-data="{
    sidebarOpen: false para Inicializar alpine.js-- >
        <
        body class ="font-sans antialiased" x-data="{ sidebarOpen: false }"
:class="{ 'overflow-y-hidden': sidebarOpen }" > <!--Si se abre el sidebar, ocultar la barra de scroll-->

<!--Para poner parte negra de la pantalla cuando se despliega el sidebar:
    1. Se muestra
    2. El div se oculte por defecto
    3. Se oculta con javascript
    4. Cerrar si se hace clic -->
<div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden" style="display: none;" x-show="sidebarOpen"
    x-on:click="sidebarOpen =false">

</div>

<!--SIDEBAR CON NAVBAR(CON TEMPLATE DE TAILWIND)-->
@include('layouts.partials.admin.sidebar')
@include('layouts.partials.admin.navigation')


<!--PARA ENCABEZADO DE PAGINA ACTUAL-->
<div class="p-4 sm:ml-64">
    <div class="mt-14">
        <div class="flex justify-between items-center">
            @include('layouts.partials.admin.breadcrumb') <!--MIGA DE PAN-->

            <div>
                @isset($action)
                    {{ $action }}
                @endisset
            </div>
        </div>

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 ">
            <!--Deja la parte del borde-->
            {{ $slot }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--Para hacer alertas-->

@livewireScripts <!--Estilos de livewire-->

@stack('js') <!--Para insertar codigo javascript-->

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
