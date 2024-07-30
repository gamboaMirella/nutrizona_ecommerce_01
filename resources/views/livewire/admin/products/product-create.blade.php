<!--CREAR NUEVO PRODUCTO-->
<div class="card">
    <div class="mb-4">
        <x-label class="mb-1">
            Código
        </x-label>
        <x-input wire:model="product.sku" class="w-full" placeholder="Ingrese el código del producto" />
    </div>

    <div class="mb-4">
        <x-label class="mb-1">
            Nombre
        </x-label>
        <x-input wire:model="product.name" class="w-full" placeholder="Ingrese el nombre del producto" />
    </div>

    <div class="mb-4">
        <x-label class="mb-1">
            Descripción
        </x-label>
        <x-textarea wire:model="product.description" class="w-full" placeholder="Ingrese la descripción del producto"></x-textarea>
    </div>

    <div class="mb-4">
        <x-label class="mb-2">
            Categoría
        </x-label>
        <x-select class="w-full" wire:model="category_id">
            <option value="" disabled>Seleccione una categoría</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>
    </div>

    <div class="mb-4">
        <x-label class="mb-2">
            Subcategoría
        </x-label>
        <x-select class="w-full" wire:model="product.subcategory_id">
            <option value="" disabled>Seleccione una subcategoría</option>
            @foreach ($this->subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
            @endforeach
        </x-select>
    </div>
</div>
