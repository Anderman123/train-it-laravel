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
            'usuario_id' => 'required|exists:usuarios,id',
            'publicacion_id' => 'required|exists:publicaciones,id',
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
            'usuario_id' => 'required|exists:usuarios,id',
            'publicacion_id' => 'required|exists:publicaciones,id',
        ]);

        $guardado->update($request->all());

        return response()->json($guardado);
    }

    public function update_workaround(Request $request, Guardado $guardado)
    {
        return $this->update($request, $guardado);
    }

    public function destroy(Guardado $guardado)
    {
        $guardado->delete();

        return response()->json(null, 204);
    }
}