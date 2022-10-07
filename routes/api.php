<?php

use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\PersonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Persona;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('/personas', [PersonaController::class, 'index']);
Route::post('/personas', [PersonaController::class, 'store']);
Route::get('/personas/{persona}', [PersonaController::class, 'show']);
Route::put('/personas/{persona}', [PersonaController::class, 'update']);
Route::delete('/personas/{persona}', [PersonaController::class, 'destroy']); */



Route::post('registro',[AutenticarController::class, 'registro']); // register
Route::post('acceso',[AutenticarController::class, 'acceso']); // login o access

// Una vez que el usuario tiene el token ya puede usar todas las rutas dentro del middleware
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('cerrarSesion',[AutenticarController::class, 'cerrarSesion']); // logout
    // Todas las rutas que estan dentro del group se pueden acceder solo si tiene un token asociado
    Route::apiResource('personas', PersonaController::class);
});