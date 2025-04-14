<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libros y Lectura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.html">Libellus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="autores.html">Autores</a></li>
                <li class="nav-item"><a class="nav-link" href="biblioteca.html">Mi Biblioteca</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.html">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header>
    <h1>Bienvenido a Mi Biblioteca</h1>
    <p>Explora, califica y comparte tus libros favoritos con otros amantes de la lectura.</p>
</header>

<!-- Sección: Biblioteca -->
<section class="container text-center my-5">
    <h2>Descubre Nuevos Libros</h2>
    <p>Tu próxima aventura literaria comienza aquí. Sumérgete en los libros mejor valorados por nuestra comunidad.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-dark text-light">
                <img src="img/libro1.jpg" class="card-img-top" alt="Libro 1">
                <div class="card-body">
                    <h5 class="card-title">La Sombra del Viento</h5>
                    <p class="card-text">Una historia de misterio y magia literaria en la Barcelona de mediados del siglo XX.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark text-light">
                <img src="img/libro2.jpg" class="card-img-top" alt="Libro 2">
                <div class="card-body">
                    <h5 class="card-title">Cien Años de Soledad</h5>
                    <p class="card-text">Descubre la magia de Macondo y el realismo mágico de Gabriel García Márquez.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark text-light">
                <img src="img/libro3.jpg" class="card-img-top" alt="Libro 3">
                <div class="card-body">
                    <h5 class="card-title">1984</h5>
                    <p class="card-text">Una advertencia profética sobre el autoritarismo y la vigilancia constante.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección: Autores -->
<section class="container my-5">
    <h2 class="text-center">Autores Destacados</h2>
    <p class="text-center">Conoce a los autores cuyas palabras nos inspiran cada día.</p>
</section>

<!-- Galería Literaria -->
<section class="container my-5">
    <h2 class="text-center">Galería Literaria</h2>
    
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/librogal1.jpg" class="d-block w-100 rounded" alt="Galería 1">
            </div>
            <div class="carousel-item">
                <img src="img/librogal2.jpg" class="d-block w-100 rounded" alt="Galería 2">
            </div>
            <div class="carousel-item">
                <img src="img/librogal3.jpg" class="d-block w-100 rounded" alt="Galería 3">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>Mi Biblioteca | Conecta a través de los libros</p>
    <?php
    try {
        $conexion = new PDO('mysql:host=db_libreria;dbname=libellus', 'root', 'rootlib');
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }

    $usuario = $conexion->query("select * from libro");

    var_dump($usuario->fetch(PDO::FETCH_ASSOC)); ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
