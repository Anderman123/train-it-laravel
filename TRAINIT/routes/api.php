<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\API\PostController;
use App\Http\Controller\API\UsuarioController;


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


// Rutas para el controlador 'UsuarioController'
Route::get('/usuarios', 'API\UsuarioController@index');
Route::get('/usuarios/{id}', 'API\UsuarioController@show');
Route::post('/usuarios', 'API\UsuarioController@store');
Route::put('/usuarios/{id}', 'API\UsuarioController@update');
Route::delete('/usuarios/{id}', 'API\UsuarioController@destroy');

// Rutas para el controlador 'GuardadoController'
Route::get('/guardados', 'API\GuardadoController@index');
Route::get('/guardados/{id}', 'API\GuardadoController@show');
Route::post('/guardados', 'API\GuardadoController@store');
Route::put('/guardados/{id}', 'API\GuardadoController@update');
Route::delete('/guardados/{id}', 'API\GuardadoController@destroy');

// Rutas para el controlador 'PostController'
Route::get('/posts', 'API\PostController@index');
Route::get('/posts/{id}', 'API\PostController@show');
Route::post('/posts', 'API\PostController@store');
Route::put('/posts/{id}', 'API\PostController@update');
Route::delete('/posts/{id}', 'API\PostController@destroy');

// Rutas para el controlador 'ComentarioController'
Route::get('/comentarios', 'API\ComentarioController@index');
Route::get('/comentarios/{id}', 'API\ComentarioController@show');
Route::post('/comentarios', 'API\ComentarioController@store');
Route::put('/comentarios/{id}', 'API\ComentarioController@update');
Route::delete('/comentarios/{id}', 'API\ComentarioController@destroy');