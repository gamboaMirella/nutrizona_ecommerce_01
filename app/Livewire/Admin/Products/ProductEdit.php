<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $productEdit;

    public $categories;
    public $category_id = '';
    public $subcategory_id = '';

    public $image;

    public function mount($product)
    {
        $this->productEdit = $product->only('sku','name','description','image_path','price','subcategory_id'); /**Extraer solo campos de interes */

        $this->categories = Category::all();

        $this->subcategory_id = $product->subcategory->id;

        $this->category_id = $product->subcategory->category_id;
    }

    public function boot()
    {
        $this->withValidator(function($validator){
            if($validator->fails())
            {
                $this->dispatch('swal',[
                    'icon' => 'error',
                    'title' => 'error',
                    'text' => 'El formulario contiene errores'
                ]);
            }
        });
    }

    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id'] = '';
    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024', //Porque asi es el nombre de la propiedad
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id,
            'productEdit.name' => 'required|max:250',
            'productEdit.description' => 'nullable',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if($this->image)
        {
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        $this->product->update($this->productEdit);

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Producto actualizado exitosamente'
        ]);

        return redirect()->route('admin.products.edit', $this->product->id);
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
