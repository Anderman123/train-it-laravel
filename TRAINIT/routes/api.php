<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\API\PostController;
use App\Http\Controller\API\UsuarioController;
use App\Http\Controller\API\RegistroController;


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

// routes/api.php
Route::post('register', [UsuarioController::class, 'register']);
Route::post('login', [UsuarioController::class, 'login']);

// Las rutas protegidas por autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
    // ... otras rutas protegidas
});