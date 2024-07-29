<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    //Habilitar campos donde se permite asignacion masiva
    protected $fillable=[
        'name',
        'category_id'
    ];

    //Definir relación inversa(de 1 categoria tiene muchas subcategorias)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    //Definir relacion 1 a muchos(1 subcategory puede tener muchos products)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
