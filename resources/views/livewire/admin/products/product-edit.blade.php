<div>
    
    <!--El evento se pone en el formulario para poder guardar también con enter-->
    <form wire:submit="store">
        <figure class="mb-4 relative">

            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
    
                    <input type="file" 
                    class="hidden" 
                    accept="image/*"
                    wire:model="image">
                </label>
            </div>
    
    
            <img class="aspect-[16/9] object-cover object-center w-full" 
            src="{{ $image ? $image->temporaryUrl() : asset('storage/img/no-image.png') }}" 
            {{-- src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}"  --}}
            {{-- src="{{ $image ? $image->temporaryUrl() : asset($productEdit['image_path']) }}"  --}}
            alt="Imagen no disponible">
        </figure>

        {{-- {{dump($productEdit['image_path']) }} --}}

        {{-- {{dump(Storage::url($productEdit['image_path']))}} --}}

        <x-validation-errors class="mb-4" />
    
        <div class="card">

            <div class="mb-4">
                <x-label class="mb-1">
                    Categorías
                </x-label>
                <x-select class="w-full" wire:model.live="category_id">
                    <option value="" disabled>
                        Seleccione una categoría
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
        
            <!--Subcategory-->
            <div class="mb-4">
                <x-label class="mb-1">
                    Subcategorías
                </x-label>
                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">
                    <option value="" disabled>
                        Seleccione una subcategoría
                    </option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Código
                </x-label>
                <x-input wire:model="productEdit.sku" 
                class="w-full" 
                placeholder="Ingrese el código del producto" />
            </div>
        
            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre
                </x-label>
                <x-input wire:model="productEdit.name" class="w-full" placeholder="Ingrese el nombre del producto" />
            </div>
        
            <div class="mb-4">
                <x-label class="mb-1">
                    Descripción
                </x-label>
                <x-textarea wire:model="productEdit.description" class="w-full" placeholder="Ingrese la descripción del producto"></x-textarea>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Precio
                </x-label>
                <x-input type="number" 
                        step="0.01"
                        wire:model="productEdit.price" 
                        class="w-full" 
                        placeholder="Ingrese el precio del producto" />
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


    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')

    </form>
    <!---->
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


