<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\CategoriaController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

// Rutas web para cargar vistas
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
// Ruta para direccionar a la vista
Route::get('/productos/{id}/editar', [ProductoController::class, 'formEdit'])->name('productos.formEdit');

// Rutas para crear
Route::post('/crearcategorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::post('/crearproductos', [ProductoController::class, 'store'])->name('productos.store');

//Ruta para eliminar
Route::delete('/eliminarproductos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

//Ruta para editar
Route::put('/editarproductos/{id}', [ProductoController::class, 'update'])->name('productos.update');

});