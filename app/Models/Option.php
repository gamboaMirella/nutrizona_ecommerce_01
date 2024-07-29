<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    //Habilitar campos que permiten asignacion masiva
    protected $fillable=[
        'name',
        'type',
    ];

    //Definir relacion 1 a muchos(1 option puede tener muchas features)
    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    //Definir relacion muchos a muchos(muchas options tienen muchos products)
    public function products()
    {
        return $this->belongsToMany(Product::class)
        ->withPivot('value')
        ->withTimestamps();
    }

}
