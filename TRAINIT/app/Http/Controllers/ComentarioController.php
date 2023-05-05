<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        return Comentario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_post' => 'required|exists:posts,id_post',
            'contenido' => 'required',
            'fecha_comentario' => 'required|date',
        ]);

        $comentario = Comentario::create($request->all());
        return response()->json($comentario, 201);
    }

    public function show(Comentario $comentario)
    {
        return $comentario;
    }

    public function update(Request $request, Comentario $comentario)
    {
        $request->validate([
            'id_usuario' => 'sometimes|required|exists:usuarios,id_usuario',
            'id_post' => 'sometimes|required|exists:posts,id_post',
            'contenido' => 'sometimes|required',
            'fecha_comentario' => 'sometimes|required|date',
        ]);

        $comentario->update($request->all());
        return response()->json($comentario, 200);
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        return response()->json(null, 204);
    }
}