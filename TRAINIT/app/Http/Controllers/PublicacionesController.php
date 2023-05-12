<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use Illuminate\Http\Request;

class PublicacionesController extends Controller
{
    public function index()
    {
        return Publicaciones::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'imagen' => 'image|max:2048', // Valida que el archivo cargado sea una imagen y su tamaño no supere los 2MB
            'video' => 'mimes:mp4,mov,ogg|max:20000', // Valida que el archivo cargado sea un vídeo y su tamaño no supere los 20MB
        ]);

        $publicaciones = Publicaciones::create($request->all());

        return response()->json($publicaciones, 201);
        
    }

    public function show(Publicaciones $publicaciones)
    {
        return $publicaciones;
    }

    public function update(Request $request, Publicaciones $publicaciones)
    {
        $request->validate([
            'descripcion' => 'required|string',
        ]);
    
        $publicaciones->update($request->only('descripcion'));
    
        return response()->json($publicaciones);
    }

    public function update_workaround(Request $request, Publicaciones $publicaciones)
    {
        return $this->update($request, $publicaciones);
    }

    public function destroy($id)
    {
        $publicacion = Publicaciones::findOrFail($id);
        $publicacion->delete();
    
        return response()->json(null, 204);
    }
}