<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    //Habilitar asignación masiva
    protected $fillable=[
        'value',
        'description',
        'option_id',
    ];

    //Definir relacion inversa(de 1 option puede tener muchas features)
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    //Definr relacion muchos a muchos(muchas features pueden tener muchas variants)
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
        ->withTimestamps();
    }
}
