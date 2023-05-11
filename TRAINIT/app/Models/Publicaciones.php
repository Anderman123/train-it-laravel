<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categoria_id',
        'descripcion',
        'imagen',
        'video',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
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