<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\GuardadoController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\UsuarioController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Las rutas protegidas por autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
    // ... otras rutas protegidas
});

// Rutas para CategoriaController
Route::apiResource('categorias', CategoriaController::class);

// Rutas para ComentarioController
Route::apiResource('comentarios', ComentarioController::class);
Route::post('comentarios{comentarios}', [ComentarioController::class, 'update_workaround']);

// Rutas para GuardadoController
Route::apiResource('guardados', GuardadoController::class);
Route::post('guardados{guardados}', [GuardadoController::class, 'update_workaround']);

// Rutas para PostController
Route::apiResource('posts', PublicacionesController::class);
Route::post('post{post}', [PublicacionesController::class, 'update_workaround']);

// Rutas para UsuarioController
Route::post('register', [UsuarioController::class, 'register']);
Route::post('login', [UsuarioController::class, 'login']);