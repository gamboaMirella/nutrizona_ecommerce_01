<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function scopeCustomOrder($query, $orderBy) {
        $query->when($orderBy == 1, function($query){
            $query->orderBy('created_at', 'desc');
        })
        ->when($orderBy == 2, function($query){
            $query->orderBy('price', 'asc');
        })
        ->when($orderBy == 3, function($query){
            $query->orderBy('price', 'desc');
        });
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->image_path),
        );
    }

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
