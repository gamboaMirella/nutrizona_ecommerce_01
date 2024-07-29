<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $category->name,
    ],
]">

    <!--FORMULARIO PARA EDITAR CATEGORIA-->
    <div class="card">
        <!--Utiliza metodo PUT Y POST-->
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-label class="mb-2"> <!--Llamar al componente label-->
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la nueva categoría" name="name"
                    value="{{ old('name', $category->name) }}" />
                <!--Llamar al componente imput: Se le asigna el nombre de la BD. Con old se recupera el nombre en caso falle alguna regla de validación, SI NO FALLA Se recupera el nombre ya guardado de la familia-->
            </div>

            <div class="flex justify-center">
                <x-button>
                    Actualizar
                </x-button>
                <x-danger-button onclick="confirmDelete()" class="ml-2">
                    Eliminar
                </x-danger-button>

            </div>
        </form>
    </div>
    <!--FIN DE FORMULARIO PARA EDITAR CATEGORIA-->

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function confirmDelete() {
                

                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit(); /** */
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
