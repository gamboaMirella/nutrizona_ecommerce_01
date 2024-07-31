<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    public $categories;

    public $subcategory=[
        'category_id'=>'',
        'name'=>''
    ];

    public function mount() 
    {
        $this->categories=Category::all();
    }

    public function save()
    {
        $this->validate([
            'subcategory.category_id'=>'required|exists:categories,id',
            'subcategory.name'=>'required'
        ],[],[
            'subcategory.category_id'=>'categoría',
            'subcategory.name'=>'nombre'
        ]);
        
        Subcategory::create($this->subcategory);

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'¡Correcto!',
            'text'=>'Subcategoría creada exitosamente'
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    public function render()
    {
        
        return view('livewire.admin.subcategories.subcategory-create');

    }
}
