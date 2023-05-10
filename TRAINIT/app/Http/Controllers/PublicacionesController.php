<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use Illuminate\Http\Request;

class PublicacionesController extends Controller
{
    public function index()
    {
        return Publicacion::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|string',
            'video' => 'nullable|string',
        ]);

        $publicacion = Publicacion::create($request->all());

        return response()->json($publicacion, 201);
    }

    public function show(Publicacion $publicacion)
    {
        return $publicacion;
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|string',
            'video' => 'nullable|string',
        ]);

        $publicacion->update($request->all());

        return response()->json($publicacion);
    }

    public function update_workaround(Request $request, Publicacion $publicacion)
    {
        return $this->update($request, $publicacion);
    }

    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();

        return response()->json(null, 204);
    }
}