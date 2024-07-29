<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $fillable=[
        'sku',
        'image_path',
        'product_id',
    ];


    //Definir relacion inversa(de 1 product tiene muchas variants)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //Definir relacion muchos a muchos(de muchas features pueden pertenecer a muchas variants)

    public function features()
    {
        return $this->belongsToMany(Feature::class)
        ->withTimestamps();
    }
}
