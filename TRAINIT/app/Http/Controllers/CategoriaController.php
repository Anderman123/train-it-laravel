<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|unique:categorias',
        ]);

        $categoria = Categoria::create($request->all());
        return response()->json($categoria, 201);
    }

    public function show(Categoria $categoria)
    {
        return $categoria;
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre_categoria' => 'sometimes|required|unique:categorias',
        ]);

        $categoria->update($request->all());
        return response()->json($categoria, 200);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(null, 204);
    }
    
    public function update_workaround(Request $request, $id){
        return $this->update($request, $id);
    }
}