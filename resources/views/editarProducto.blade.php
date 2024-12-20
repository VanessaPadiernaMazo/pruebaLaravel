<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PruebaLaravel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fst-italic fw-lighter">Vanessa Padierna Mazo</a>
            <div class="collapse navbar-collapse justify-content-end nav-pills" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link me-4 active" id="productos" href="{{ route('productos.index') }}">Productos</a>
                    <a class="nav-link me-4" id="categorias" href="{{ route('categorias.index') }}">Categorías</a>
                </div>
            </div>
        </div>
    </nav>

    <h3 class="text-center">Editar producto</h3>

    <div class="card">
        <div class="card-body">
            <form id="editProductoForm" method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Esto indica que es una actualización -->
                <!-- Nombre del Producto -->
                <div class="mb-3">
                    <label for="productName" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="productName" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                </div>
                <!-- Precio del Producto -->
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="productPrice" name="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" required>
                </div>
                <!-- Categoría del Producto -->
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Categoría</label>
                    <select class="form-select" id="productCategory" name="categoria_id" required>
                        <option value="" disabled>Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Botón de actualización -->
                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            </form>
        </div>
    </div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>