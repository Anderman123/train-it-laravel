<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardado extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'publicacion_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class);
    }
}