<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $role1 = Role::create(['name' => 'costumer']);

        User::create([              //rol de administrador
            'name' => 'Daniel',
            'last_name' => 'Perez',
            'document_number' => '18224495',
            'email' => 'daniel70@gmail.com',
            'phone' => '945564412',
            'password'=> bcrypt('12345678'),
        ])->assignRole('admin');  //le pasamos el nombre del rol o toda la variable $role

        User::create([          //usuario sin rol definido
            'name' => 'Mario',
            'last_name' => 'Sánchez',
            'document_number' => '76841274',
            'email' => 'm@gmail.com',
            'phone' => '987423145',
            'password'=> bcrypt('12345678'),
        ])->assignRole('costumer');
    }
}
