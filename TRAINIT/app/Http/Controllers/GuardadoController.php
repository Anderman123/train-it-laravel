<?php

namespace App\Http\Controllers;

use App\Models\Guardado;
use Illuminate\Http\Request;

class GuardadoController extends Controller
{
    public function index()
    {
        return Guardado::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_post' => 'required|exists:posts,id_post',
        ]);

        $guardado = Guardado::create($request->all());
        return response()->json($guardado, 201);
    }

    public function show(Guardado $guardado)
    {
        return $guardado;
    }

    public function update(Request $request, Guardado $guardado)
    {
        $request->validate([
            'id_usuario' => 'sometimes|required|exists:usuarios,id_usuario',
            'id_post' => 'sometimes|required|exists:posts,id_post',
        ]);

        $guardado->update($request->all());
        return response()->json($guardado, 200);
    }

    public function destroy(Guardado $guardado)
    {
        $guardado->delete();
        return response()->json(null, 204);
    }
}