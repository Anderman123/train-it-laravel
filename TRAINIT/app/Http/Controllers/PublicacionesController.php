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
            'imagen' => 'nullable|image|max:2048', // Valida que el archivo cargado sea una imagen y su tamaño no supere los 2MB
            'video' => 'nullable|url', // Valida que el archivo cargado sea un vídeo y su tamaño no supere los 20MB
        ]);
    
        // Comenzar a preparar los datos para crear la publicación
        $postData = $request->only(['user_id', 'categoria_id', 'descripcion', 'video']);
    
        if ($request->hasFile('imagen')) {
            // Manejar la subida de la imagen
            $imagen = $request->file('imagen');
            $nombreImagen = time().'.'.$imagen->getClientOriginalExtension();
            $destino = public_path('/imagenes');
            $imagen->move($destino, $nombreImagen);
            
            // Añadir la URL de la imagen a los datos de la publicación
            $postData['imagen'] = url('/imagenes/'.$nombreImagen);
        }
    
        $publicaciones = Publicaciones::create($postData);
    
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