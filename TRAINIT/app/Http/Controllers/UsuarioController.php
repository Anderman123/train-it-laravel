<?php

namespace App\Http\Controllers;

// use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:8',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($usuario, 201);
    }

    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'required|string|min:8',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($usuario);
    }

    public function update_workaround(Request $request, Usuario $usuario)
    {
        return $this->update($request, $usuario);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json(null, 204);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8',
        ]);
    
        $usuarios = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        if (Auth::attempt($request->only(['email', 'password']))) {
            $usuarios = Auth::usuarios();
            $token = $usuarios->createToken('Personal Access Token')->plainTextToken;
    
            return response()->json(['access_token' => $token], 200);
        }
    
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
}