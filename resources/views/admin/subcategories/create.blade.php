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
        'name' => 'Crear',
    ],
]">

    <!--FORMULARIO PARA GUARDAR NUEVA SUBCATEGORIA-->

<form action="{{ route('admin.subcategories.store') }}" method="POST">
    @csrf
    <div class="card">
        <x-validation-errors class="mb-4" /> <!--Muestra error si el usuario no rellena un campo-->

        <div class="mb-4">
            <x-label class="mb-2">
                Categoría
            </x-label>

            

            <x-select name="category_id" class="w-full">
                <option value="" disabled @unless(old('category_id')) selected @endunless>
                    Seleccione una categoría
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
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
                value="{{ old('name') }}" />
            <!--Llamar al componente imput: Se le asigna el nombre de la BD. Con old se recupera el nombre en caso falle alguna regla de validación-->
        </div>

        <div class="flex justify-center">
            <x-button>
                Guardar
            </x-button>
        </div>
    </div>
</form>

    <!--FIN DE FORMULARIO PARA GUARDAR NUEVA SUBCATEGORIA-->

</x-admin-layout>
