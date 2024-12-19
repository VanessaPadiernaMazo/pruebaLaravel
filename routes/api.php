<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;

//Route::apiResource('productos', ProductoController::class);
Route::get('productos', [ProductoController::class, 'index']);