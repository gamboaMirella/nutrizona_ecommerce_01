<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku'=> $this->faker->unique()->numberBetween(1000,9999), /**Genera numeros unicos en ese rango */
            'name'=>$this->faker->sentence(),
            'description' =>$this->faker->text(20),
            'image_path'=>'products/'. $this->faker->image('public/storage/products', 640,480,null,false), //true: Retorna toda la ruta desde public, si es false: solo el nombre de la imagen.
            'price'=>$this->faker->randomFloat(2,5,15),
            'subcategory_id'=>$this->faker->numberBetween(1,13),
        ];
    }
}
