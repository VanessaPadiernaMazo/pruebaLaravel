<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;

Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::post('/crearproductos', [ProductoController::class, 'store']);
Route::put('/editarproductos/{id}', [ProductoController::class, 'update']);
Route::delete('/eliminarproductos/{id}', [ProductoController::class, 'destroy']);

//Route::apiResource('productos', ProductoController::class);
//Route::get('/productos', function (){
//return "Holaaaaaaaaaaaaaa";
//});