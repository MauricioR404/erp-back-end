<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| ACLARACION
|--------------------------------------------------------------------------
| En este proyecto se unifican las rutas API y las rutas web en este archivo,
| ya que debido al tiempo de 4 horas no pude solucionar un problema para separar
| las rutas API y las rutas web en archivos diferentes.
*/

// Ruta base para verificar que la API está en línea
Route::get('/', function () {
    return response()->json(['mensaje' => 'API de gestión de clientes en funcionamiento']);
});

// Ruta pública de login
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por Sanctum (requieren token)
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD de clientes
    Route::get('/clientes', [ClienteController::class, 'index']);       
    Route::post('/clientes', [ClienteController::class, 'store']);    
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update']);
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy']); 
});
