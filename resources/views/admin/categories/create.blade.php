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
        'name'=>'Crear',
    ]
]">


  <!--FORMULARIO PARA GUARDAR NUEVA CATEGORIA-->
  <div class="card">
    <form action="{{route('admin.categories.store')}}" method="POST">
      @csrf

      <x-validation-errors class="mb-4" /> <!--Muestra error si el usuario no rellena un campo-->
      <div class="mb-4">
        <x-label class="mb-2"> <!--Llamar al componente label-->
          Nombre
        </x-label>
        <x-input class="w-full" placeholder="Ingrese el nombre de la nueva categoría" name="name" value="{{old('name')}}"/> <!--Llamar al componente imput: Se le asigna el nombre de la BD. Con old se recupera el nombre en caso falle alguna regla de validación-->
      </div>

      <div class="flex justify-center">
        <x-button>
          Guardar
        </x-button>
      </div> 
    </form>
  </div>
  <!--FIN DE FORMULARIO PARA GUARDAR NUEVA CATEGORIA-->

</x-admin-layout>