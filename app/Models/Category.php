<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Habilitar signación masiva
    protected $fillable=[
        'name',
    ];

    //Definir relacion 1 a muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class); //Devuelve todas las subcategorias de cada categoria
    }
}
