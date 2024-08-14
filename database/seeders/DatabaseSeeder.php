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
        Storage::deleteDirectory('products'); //para manipular los archivos cada vez que se realiza la migración
        Storage::makeDirectory('products');

        // User::factory()->create([ /**Crear usuario por defecto */
        //     'name' => 'Daniel',
        //     'last_name' => 'Perez',
        //     'document_number' => '18224495',
        //     'email' => 'daniel70@gmail.com',
        //     'phone' => '945564412',
        //     'password'=> bcrypt('12345678')
        // ]);

        //Llamar al CategorySeeder: Poblar la DB con las categorias definidas
        $this->call([
            CategorySeeder::class,
        ]);
        
        $this->call([
            UserSeeder::class,
        ]);

        User::factory(20)->create();
        Product::factory(50)->create();
    }
}
