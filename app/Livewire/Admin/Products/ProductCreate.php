<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;


    public $categories;
    public $category_id = '';
    public $subcategory_id = '';

    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->categories = Category::all();
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
        $this->product['subcategory_id'] = '';
    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:1024', //Porque asi es el nombre de la propiedad
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:250',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $this->product['image_path'] = $this->image->store('products');
        $product = Product::create($this->product);

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Producto creado exitosamente'
        ]);

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
