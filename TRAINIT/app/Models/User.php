<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
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