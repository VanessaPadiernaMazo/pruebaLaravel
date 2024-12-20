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
                    <a class="nav-link me-4" id="productos" href="{{ route('productos.index') }}">Productos</a>
                    <a class="nav-link me-4 active" id="categorias" href="{{ route('categorias.index') }}">Categorías</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Categorías sin productos -->
    <div class="card">
        <div class="card-body">
            @if ($categoriasSinProductos->isNotEmpty())
                <h4>Categorías sin productos:</h4>
                <ul>
                    @foreach ($categoriasSinProductos as $categoria)
                        <li>{{ $categoria->nombre }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Categorías -->
    <ul class="cards">
        @foreach ($categorias as $categoria)
        <li>
            <div class="card_">
                <img src="{{ asset('img/categorias.jpg') }}" class="card__image" />
                <div class="card__overlay">
                    <div class="card__header">                    
                        <img class="card__thumb" src="{{ asset('img/categorias.jpg') }}" />
                        <div class="card__header-text">
                            <h3 class="card__title">{{ $categoria->nombre }}</h3>            
                        </div>
                    </div>

                    <div class="p-3">
                        <!-- Muestra los productos con un precio mayor al promedio -->
                        <div>
                            <p class="card__description fs-6">Productos con precio mayor al promedio:</p>
                            <ul>
                                @foreach ($categoria->productos_mayores_al_promedio as $producto)
                                    <li><p class="card__description fs-6">{{ $producto->nombre }} - ${{ $producto->precio }}</p></li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Muestra la cantidad de productos en la categoría -->
                        <div>
                        <p class="card__description fs-6">Productos en esta categoría: {{ $categoria->productos_count }}</p>
                        </div>
                    </div>
                </div>
            </div>      
        </li> 
        @endforeach
    </ul>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
