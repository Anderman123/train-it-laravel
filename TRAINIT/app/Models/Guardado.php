<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_usuario',
        'id_post',
        'contenido',
        'fecha_comentario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
}