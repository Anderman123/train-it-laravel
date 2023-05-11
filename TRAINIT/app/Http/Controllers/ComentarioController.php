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
            'user_id' => 'required|exists:users,id',
            'publicacion_id' => 'required|exists:publicaciones,id',
            'contenido' => 'required|string',
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
            'contenido' => 'required|string',
        ]);

        $comentario->update($request->all());

        return response()->json($comentario);
    }

    public function update_workaround(Request $request, Comentario $comentario)
    {
        return $this->update($request, $comentario);
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        return response()->json(null, 204);
    }
}