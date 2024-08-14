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

    <!-- Stilos para el boton de tamaño de fuente -->
    <style>
        #fontSizeControl {
            position: fixed;
            bottom: 1.25rem;
            /* bottom-5 */
            right: 1.25rem;
            /* right-5 */
            display: flex;
            align-items: center;
            justify-content: center;
            /* Centra los botones horizontalmente */
            background-color: #1f2937;
            /* bg-gray-800 */
            color: #ffffff;
            /* text-white */
            padding: 0.5rem;
            /* p-2 */
            border-radius: 0.5rem;
            /* rounded-lg */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            /* shadow-lg */
            z-index: 50;
            font-size: 16px;
            /* Tamaño de fuente fijo para el botón flotante */
        }

        #fontSizeControl button {
            font-size: 14px;
            /* Tamaño de fuente fijo para los botones */
            background-color: #374151;
            /* bg-gray-700 */
            border-radius: 0.25rem;
            /* rounded */
            padding: 0.25rem 0.75rem;
            /* Aumenta el padding para uniformidad */
            margin-left: 0.5rem;
            /* Espaciado entre los botones */
            cursor: pointer;
            flex: 1;
            /* Hace que los botones tengan el mismo tamaño */
            text-align: center;
            /* Centra el texto dentro de los botones */
        }

        #fontSizeControl button:first-child {
            margin-left: 0;
            /* Elimina el margen izquierdo del primer botón */
        }

        #fontSizeControl button:hover {
            background-color: #4b5563;
            /* hover:bg-gray-600 */
        }
    </style>

</head>

<body class ="font-sans antialiased" x-data="{
    sidebarOpen: false
}" :class="{ 'overflow-y-hidden': sidebarOpen }">

    <!--Si se abre el sidebar, ocultar la barra de scroll-->

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

    {{-- ------ Botones flotantes para regular fuente ---------- --}}
    <div id="fontSizeControl">
        <button id="decreaseFontSize">A-</button>
        <button id="resetFontSize">A</button>
        <button id="increaseFontSize">A+</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--Para hacer alertas-->

    @livewireScripts <!--Estilos de livewire-->

    @stack('js') <!--Para insertar codigo javascript-->

    @if (session('swal'))
        <!--Escuchar eventos de la variable de sesión-->
        <script>
            Swal.fire({!! json_encode(session('swal')) !!}); /**json_encode: Transformar php en javascript*/
        </script>
    @endif

    <!--Escuchar los eventos de se emitan en livewire-->
    <script>
        Livewire.on('swal', data => {
            Swal.fire(data[0]);
        })

        //----------------- MANEJO DE BOTONES PARA LA FUENTE-------------
        document.addEventListener('DOMContentLoaded', function() {
            const decreaseFontSize = document.getElementById('decreaseFontSize');
            const resetFontSize = document.getElementById('resetFontSize');
            const increaseFontSize = document.getElementById('increaseFontSize');

            let currentFontSize = 16; // Tamaño de fuente base

            decreaseFontSize.addEventListener('click', function() {
                currentFontSize = Math.max(12, currentFontSize - 2);
                document.documentElement.style.fontSize = currentFontSize + 'px';
            });

            resetFontSize.addEventListener('click', function() {
                currentFontSize = 16;
                document.documentElement.style.fontSize = currentFontSize + 'px';
            });

            increaseFontSize.addEventListener('click', function() {
                currentFontSize = Math.min(24, currentFontSize + 2);
                document.documentElement.style.fontSize = currentFontSize + 'px';
            });
        });
    </script>


</body>

</html>
