<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\CategoriaController;

Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/categorias', [CategoriaController::class, 'index']);

//Route::apiResource('productos', ProductoController::class);
//Route::get('/productos', function (){
//return "Holaaaaaaaaaaaaaa";
//});