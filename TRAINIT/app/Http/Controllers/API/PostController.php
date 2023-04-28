<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['usuario', 'comentarios'])->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'usuario_id' => 'required|integer|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $post = new Post();
        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->usuario_id = $request->usuario_id;
        $post->save();

        return response()->json(['message' => 'Post creado con éxito', 'post' => $post], 201);
    }

    public function show($id)
    {
        $post = Post::with(['usuario', 'comentarios'])->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'string|max:255',
            'contenido' => 'string',
            'usuario_id' => 'integer|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($request->titulo) {
            $post->titulo = $request->titulo;
        }

        if ($request->contenido) {
            $post->contenido = $request->contenido;
        }

        if ($request->usuario_id) {
            $post->usuario_id = $request->usuario_id;
        }

        $post->save();

        return response()->json(['message' => 'Post actualizado con éxito', 'post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post eliminado con éxito']);
    }
    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }
}
