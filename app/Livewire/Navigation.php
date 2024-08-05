<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public $categories;

    public $category_id;

    public function mount()
    {
        $this->categories = \App\Models\Category::all();
        $this->category_id = \App\Models\Category::first()->id;
    }

    #[Computed()]
    public function subcategories()
    {
        return \App\Models\Subcategory::where('category_id', $this->category_id)->get();
    }

    #[Computed()]
    public function categoryName()
    {
        return \App\Models\Category::find($this->category_id)->name;
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
