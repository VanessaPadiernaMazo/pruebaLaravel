<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaController
{
    public function index(Request $request)
    {
        // Obtener todas las categorías con sus productos relacionados
        $categorias = Categoria::with('productos') // Obtén las categorías con los productos
                                ->get();

        // Recorre las categorías y agrega el promedio y los productos mayores al promedio
        foreach ($categorias as $categoria) {
            // Verificamos si la categoría tiene productos
            if ($categoria->productos->isNotEmpty()) {
                $promedioPrecio = $categoria->productos->avg('precio'); // Calcula el promedio de precio

                // Filtra los productos que tienen un precio mayor al promedio
                $productosMayoresAlPromedio = $categoria->productos->filter(function($producto) use ($promedioPrecio) {
                    return $producto->precio > $promedioPrecio;
                });

                // Asignamos la lista de productos mayores al promedio
                $categoria->productos_mayores_al_promedio = $productosMayoresAlPromedio;
            } else {
                // Si no hay productos, asignamos una colección vacía
                $categoria->productos_mayores_al_promedio = collect();
            }

            // Cuenta los productos de la categoría
            $categoria->productos_count = $categoria->productos->count();
        }

        // Filtra las categorías que no tienen productos
        $categoriasSinProductos = $categorias->filter(function($categoria) {
            return $categoria->productos_count == 0;
        });

        return view('categorias', compact('categorias', 'categoriasSinProductos'));

        if ($request->expectsJson()) {
            return response()->json([
                'categorias' => $categorias,
            ]);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|unique:categorias,nombre|max:255',
        ]);

        $categoria = Categoria::create($validatedData);

        return response()->json([
            'message' => 'Categoría creada con éxito',
            'categoria' => $categoria,
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $categoria = Categoria::with('productos')->find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        return response()->json($categoria);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|unique:categorias,nombre|max:255',
        ]);

        $categoria->update($validatedData);

        return response()->json([
            'message' => 'Categoría actualizada con éxito',
            'categoria' => $categoria,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada con éxito']);
    }
}
