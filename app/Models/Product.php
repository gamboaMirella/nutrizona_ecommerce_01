<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'subcategory_id',
    ];

    //Definir relacion inversa (de 1 subcategory tiene muchos products)
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //Definir relacion 1 a muchos(1 product tiene muchas variants)
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    //Definir relacion muchos a muchos(muchos productos tienen muchas options)
    public function options()
    {
        return $this->belongsToMany(Option::class)
        ->withPivot('value')
        ->withTimestamps();
    }
}
