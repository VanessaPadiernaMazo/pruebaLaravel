<?php

namespace App\Http\Controllers\Api;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaController
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();

        if ($request->expectsJson()) {
            return response()->json($categorias);
        }

        return view('categorias', compact('categorias'));
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
