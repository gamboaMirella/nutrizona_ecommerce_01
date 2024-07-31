<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4" /> <!--Muestra error si el usuario no rellena un campo-->
    
            <div class="mb-4">
                <x-label class="mb-2">
                    Categoría
                </x-label> 

                <x-select name="category_id" 
                            class="w-full" 
                            wire:model.live="subcategoryEdit.category_id">

                    <option value="" disabled>
                        Seleccione una categoría
                    </option>
                    @foreach ($this->categories as $category) <!--?: $this-> -->
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>
    
            <div class="mb-4">
                <x-label class="mb-2"> <!--Llamar al componente label-->
                    Nombre
                </x-label>
                <x-input class="w-full" 
                        placeholder="Ingrese el nombre de la nueva subcategoría"
                        wire:model.live="subcategoryEdit.name" />
            </div>


    
            <div class="flex justify-center">
                <x-danger-button onclick="confirmDelete()" >
                    Eliminar
                </x-danger-button>

                <x-button class="ml-2">
                    Actualizar
                </x-button>
            </div>
        </div>
    </form>


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
</div>