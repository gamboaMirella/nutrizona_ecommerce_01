<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

    {{-- <x-slot name="action"> <!--BOTON DE AGREGAR userO-->
        <a class="btn btn-orange" href="{{ route('admin.users.create') }}">
            Crear
        </a>
    </x-slot> --}}

    <div class="px-6 py-4">

      <x-input oninput="search(this.value)" type="text" class="w-full" placeholder="Buscar por nombre" />

    </div>

    @if ($users->count())

      <!--TABLA PARA MOSTRAR CATEGORIAS-->
      <div class="relative overflow-x-auto rounded-lg shadow-lg">

              <table class="w-full text-sm text-left rtl:text-right text-gray-700">

                  <thead class="text-xs text-black uppercase bg-orange-300 ">
                      <tr>
                          <th scope="col" class="px-6 py-3">
                            ID
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Nombre
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Apellidos
                          </th>
                          <th scope="col" class="px-6 py-3">
                            DNI
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Correo
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Teléfono
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Rol
                          </th>

                          <th scope="col" class="px-6 py-3">
                            Rol admin
                          </th>

                          <th scope="col" class="px-6 py-3">
                            Acción
                          </th>
                      </tr>
                  </thead>

                  <tbody>
                      @foreach ($users as $user)

                          <tr class="bg-gray-100 border-b ">
                              <th scope="row"
                                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->id }}
                              </th>

                              <td class="px-6 py-4">
                                {{ $user->name }}
                              </td>

                              <td class="px-6 py-4">
                                {{ $user->last_name }}
                              </td>

                              <td class="px-6 py-4">
                                {{ $user->document_number }}
                              </td>    

                              <td class="px-6 py-4">
                                {{ $user->email }}
                              </td>
                              <td class="px-6 py-4">
                                {{ $user->phone }}
                              </td>

                              <td class="px-6 py-4">
                                @if ($user->hasRole('admin'))
                                    Admin
                                @else
                                    Cliente
                                @endif
                                {{-- {{dump($user->roles->first())}} --}}
                                
                              </td>

                              <td>
                                <label>
                                  <input {{$user->hasRole('admin') ? 'checked' : ''}} 
                                  value="1" type="radio" name="{{$user->email}}"
                                  wire:change="assignRole({{ $user->id }}, $event.target.value)">
                                  Sí
                                </label>

                                <label class="ml-2">
                                  <input {{$user->hasRole('customer') ? 'checked' : ''}} 
                                  value="0" type="radio" name="{{$user->email}}"
                                  wire:change="assignRole({{ $user->id }}), $event.target.value">
                                  No
                                </label>

                                
                              </td>

                              <td >
                                <div class="flex justify-start">

                                    {{-- <button onclick="confirmDelete()" href="{{ route('admin.users.edit', $user) }}"  --}}
                                    {{-- class="flex flex-col items-center hover:text-red-600 px-2"> --}}

                                      <i class="fa-solid fa-user-minus text-xm"></i>
                                      <span class="text-xs"> Eliminar </span> <!-- Texto naranja -->

                                    </button>
                                    
                                </div>
                            </td>
                            
                          </tr>
                      @endforeach
                  </tbody>
                  
              </table>
      </div>

      <!--LINKS DE PAGINACION-->
      @if ($user->hasPage)
        <div class="px-6 py-4">
            {{ $users->links() }}
        </div> 
      @endif 
      <!--FIN LINKS DE PAGINACION-->

    @else
        <!--ALERTA DE userOS-->
        <div class="flex items-center p-4 text-sm text-orange-800 rounded-lg bg-blue-50"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">¡Alerta!</span> No existen usuarios registrados.
            </div>
        </div>
        <!--FIN DE ALERTA DE CATEGORIAS-->

    @endif

    {{-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="delete-form"> --}}
      @csrf
      @method('DELETE')
    </form>

    @push('js')

      <script>

          function search(value) {
              Livewire.dispatch('search', {
                  search: value
              })
          }

          function confirmDelete() {
            Swal.fire({
                title: "¿Estas seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, deseo eliminar!",
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
