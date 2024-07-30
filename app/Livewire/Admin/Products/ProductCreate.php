<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductCreate extends Component
{
    public $categories;
    public $category_id ='';

    public $product = [
        'sku'=> '',
        'name' => '',
        'description'=> '',
        'image_path'=> '',
        'price'=> '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    #[Computed()]
    public function subcategories() /**Para acceder al metodo como si fuera una propiedad computada */
    {
        return Subcategory::where('category_id',$this->category_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
