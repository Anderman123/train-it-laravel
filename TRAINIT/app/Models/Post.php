<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id_post';

    protected $fillable = [
        'archivo',
        'descripcion',
        'fecha_publicacion',
        'id_categoria',
    ];

    protected $dates = [
        'fecha_publicacion',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}   