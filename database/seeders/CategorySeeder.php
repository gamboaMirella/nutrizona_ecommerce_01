<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Batidos'=>[
                'Post entreno',
                'Frutados',
                'Chocolatosos',
                'Clasicos',
                'Especiales'
            ],
    
            'Frappes'=>[
                'Frutados',
                'Clasicos',
                'Especiales'
            ],
    
            'Refrescos'=>[
                'Con colágeno',
                'Con proteína',
                'Energizantes'
            ],
    
            'Waffles'=>[
                'Simples',
                'Especiales'
            ],
        ];

        foreach($categories as $category => $subcategories)
        {
            $category=Category::create([ //Se crea una instancia de la clase category y en su campo name se guarda la categoria actual 
                'name'=> $category,
            ]);

            foreach($subcategories as $subcategory)
            {
                $subcategory=Subcategory::create([
                    'name'=>$subcategory,
                    'category_id'=>$category->id,
                ]);
            }
        }
    }
}
