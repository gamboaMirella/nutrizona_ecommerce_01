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
                            wire:model.live="subcategory.category_id">

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
                        wire:model.live="subcategory.name" />
            </div>
    
            <div class="flex justify-center">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>
    </form>

    {{-- @dump($subcategory) --}}
</div>