<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

        User::factory()->create([ /**Crear usuario por defecto */
            'name' => 'Daniel Perez',
            'email' => 'daniel70@gmail.com',
            'password'=> bcrypt('12345678')
        ]);

        //Llamar al CategorySeeder: Poblar la DB con las categorias definidas
        $this->call([
            CategorySeeder::class,
        ]);

        Product::factory(100)->create();
    }
}
