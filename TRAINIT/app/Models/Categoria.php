<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public static function agregarCategoriasSiNoExisten(array $nombresDeCategorias): void
    {
        foreach ($nombresDeCategorias as $nombre) {
            self::firstOrCreate(['nombre' => $nombre]);
        }
    }
}