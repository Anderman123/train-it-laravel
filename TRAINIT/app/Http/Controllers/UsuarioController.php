<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8',
        ]);

        $usuario = new Usuario;
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // ... otros métodos del controlador
}