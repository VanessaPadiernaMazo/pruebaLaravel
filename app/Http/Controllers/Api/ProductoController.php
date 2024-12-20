<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoController
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::all();

        if ($request->expectsJson()) {
            return response()->json([
                'productos' => $productos,
                'categorias' => $categorias,
            ]);
        }

        // Pasar tanto productos como categorías a la vista
        return view('productos', compact('productos', 'categorias'));
    }

    public function formEdit($id)
    {
        // Encuentra el producto por su ID
        $producto = Producto::findOrFail($id);
    
        // Obtén todas las categorías disponibles
        $categorias = Categoria::all();
    
        // Pasa el producto y las categorías a la vista de edición
        return view('editarProducto', compact('producto', 'categorias'));
    }
    

    public function store(Request $request)//: JsonResponse
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|unique:productos,nombre|max:255',
            'precio' => 'required|numeric|min:0.01',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Crear el nuevo producto
        $producto = Producto::create($validatedData);

        // Retornar una respuesta JSON indicando éxito
        /*return response()->json([
            'message' => 'Producto creado con éxito',
            'producto' => $producto,
        ], 201);*/

        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
    }

    public function show($id): JsonResponse
    {
        $producto = Producto::with('categoria')->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        // Encontramos el producto por su id
        $producto = Producto::findOrFail($id);

        // Actualizamos los datos del producto
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria_id = $request->input('categoria_id');

        // Guardamos los cambios en la base de datos
        $producto->save();

        // Redirigimos o devolvemos respuesta, según tu preferencia
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
