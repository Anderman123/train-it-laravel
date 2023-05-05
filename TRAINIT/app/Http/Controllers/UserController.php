<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function insertUsuarios()
    {
        DB::table('usuarios')->insert([
            ['nombre' => 'Juan', 'email' => 'juan@example.com', 'password' => bcrypt('contraseña')],
            ['nombre' => 'Maria', 'email' => 'maria@example.com', 'password' => bcrypt('contraseña')],
            ['nombre' => 'Pedro', 'email' => 'pedro@example.com', 'password' => bcrypt('contraseña')],
        ]);
        
        return 'Usuarios insertados correctamente';
    }
}