<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class Filter extends Component
{
    use WithPagination;
    public $category_id;

    public $orderBy = 1;

    public $search;

    public $subcategory_id;

    #[On('search')]

    public function search($search)
    {
        $this->search = $search;
    }

    public function render()
    {   
        $products = Product::when($this->category_id, function($query){
            $query->whereHas('subcategory', function ($query) {
                $query->where('category_id', $this->category_id);
            });
        })
        ->when($this->subcategory_id, function($query){
            $query->where('subcategory_id', $this->subcategory_id);
        })
        ->customOrder($this->orderBy)
        ->when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->paginate(12);

        return view('livewire.filter', compact('products'));
    }
}
