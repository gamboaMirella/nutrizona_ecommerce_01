<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => $subcategory->name,
    ],
]">

    <!--FORMULARIO PARA EDITAR SUBCATEGORIA-->

    <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <x-validation-errors class="mb-4" /> <!--Muestra error si el usuario no rellena un campo-->

            <div class="mb-4">
                <x-label class="mb-2">
                    Categoría
                </x-label>

                <x-select name="category_id" class="w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $subcategory->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-2"> <!--Llamar al componente label-->
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la nueva subcategoría" name="name"
                    value="{{ old('name', $subcategory->name) }}" />
                <!--Llamar al componente imput: Se le asigna el nombre de la BD. Con old se recupera el nombre en caso falle alguna regla de validación-->
            </div>

            <div class="flex justify-center">                
                <x-button>
                    Actualizar
                </x-button>
                <x-danger-button onclick="confirmDelete()" class="ml-2">
                    Eliminar
                </x-danger-button>
            </div>
        </div>
    </form>
    <!--FIN DE FORMULARIO PARA EDITAR SUBCATEGORIA-->


    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" id="delete-form">
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
