<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'password',
    ];

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function guardados()
    {
        return $this->hasMany(Guardado::class);
    }
}