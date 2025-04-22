<?php
session_start();

require_once '../modelo/Autor.php';
require_once '../modelo/Libro.php';
require_once '../modelo/Genero.php';

if (!isset($_SESSION['usuario']) || $_SESSION['administrador'] != "1") {
    header("Location: login.php?mensaje=Inicie sesión primero.");
    exit();
}


// Obtener los datos que mostraré en los formularios
$lista_autores = [];
$lista_generos = [];
$lista_libros = [];
try {
    $lista_autores = Autor::listarAutores();
    $lista_generos = Genero::listarGeneros();
    $lista_libros = Libro::listarLibros();
} catch (Exception $e) {
    $error_carga = "Error fatal al cargar datos necesarios: " . $e->getMessage();
}


// Obtener, si hay, mensajes
$mensaje_exito = $_SESSION['mensaje_exito'] ?? null;
$mensaje_error = $_SESSION['mensaje_error'] ?? null;
unset($_SESSION['mensaje_exito'], $_SESSION['mensaje_error']);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libellus - Gestión</title>
    <link rel="stylesheet" href="./css/areaAdmin.css">

    <script>
        function mostrarFormulario(idFormulario) {
            // Ocultar todos los formularios primero
            const formularios = document.querySelectorAll('.formulario-contenedor');
            formularios.forEach(form => {
                form.style.display = 'none';
            });

            // Mostrar el formulario que ha seleccionado el admin
            const formularioSeleccionado = document.getElementById(idFormulario);
            if (formularioSeleccionado) {
                formularioSeleccionado.style.display = 'block';
                formularioSeleccionado.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }
    </script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="">
        </div>
        <div class="titulo">
            <a href="../index.html">Libellus</a>
        </div>
        <nav>
            <a href="../controlador/cerrar_sesion.php">Cerrar sesión</a>
        </nav>
    </header>

    <div class="container">

        <main>
            <h1>Panel de Gestión</h1>

            <div class="acciones">
                <button onclick="mostrarFormulario('form_nuevo_autor')">Añadir Nuevo Autor</button>
                <button onclick="mostrarFormulario('form_nuevo_libro')">Añadir Nuevo Libro</button>
                <button onclick="mostrarFormulario('form_borrar_autor')">Borrar Autor</button>
                <button onclick="mostrarFormulario('form_borrar_libro')">Borrar Libro</button>
            </div>

            <?php if (isset($error_carga)){ // Muestra si hubo error al cargar la base de datos 
            ?>
                <div class="mensaje-error"><?php echo htmlspecialchars($error_carga); ?></div>
            <?php }; ?>
            <?php if ($mensaje_exito){ ?>
                <div class="mensaje-exito"><?php echo htmlspecialchars($mensaje_exito); ?></div>
            <?php }; ?>
            <?php if ($mensaje_error){ ?>
                <div class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></div>
            <?php }; ?>

            <div id="formularios-gestion">

                <div id="form_nuevo_autor" class="formulario-contenedor" style="display: none;">
                    <div>
                        <h2>Añadir Nuevo Autor</h2>
                    </div>
                    <form action="../controlador/controladorAdmin.php" method="POST">
                        <div>
                            <label for="nom_autor">Nombre del Autor:</label>
                            <input type="text" id="nom_autor" name="nom_autor" required maxlength="100">
                        </div>
                        <button type="submit" name="accion" value="nuevo_autor">Guardar Autor</button>
                    </form>
                </div>

                <div id="form_nuevo_libro" class="formulario-contenedor" style="display: none;">
                    <div>
                        <h2>Añadir Nuevo Libro</h2>
                    </div>
                    <form action="../controlador/controladorAdmin.php" method="POST">
                        <div>
                            <label for="titulo">Título:</label>
                            <input type="text" id="titulo" name="titulo" required maxlength="200">
                        </div>
                        <div>
                            <label for="portada">URL Portada:</label>
                            <input type="url" id="portada" name="portada" placeholder="https://ejemplo.com/portada.jpg">
                        </div>
                        <div>
                            <label for="sinopsis">Sinopsis:</label>
                            <textarea id="sinopsis" name="sinopsis" required maxlength="400"></textarea>
                        </div>
                        <div>
                            <label for="fec_publicacion">Fecha Publicación:</label>
                            <input type="date" id="fec_publicacion" name="fec_publicacion">
                        </div>
                        <div>
                            <label for="url_compra">URL Compra:</label>
                            <input type="url" id="url_compra" name="url_compra" placeholder="https://tienda.com/libro">
                        </div>

                        <div class="checkbox-grupo">
                            <h3>Autores:</h3>
                            <?php if (!empty($lista_autores)){ ?>
                                <?php foreach ($lista_autores as $autor){ ?>
                                    <label>
                                        <input type="checkbox" name="autores[]" value="<?php echo $autor->getIdAutor(); ?>">
                                        <?php echo htmlspecialchars($autor->getNomAutor() ?? 'Nombre no disponible'); ?>
                                    </label>
                                <?php }; ?>
                            <?php }else{ ?>
                                <p>No hay autores disponibles. Añade autores primero.</p>
                            <?php }; ?>
                        </div>

                        <div class="checkbox-grupo">
                            <h3>Géneros:</h3>
                            <?php if (!empty($lista_generos)){ ?>
                                <?php foreach ($lista_generos as $genero){ ?>
                                    <label>
                                        <input type="checkbox" name="generos[]" value="<?php echo $genero->getIdGenero(); ?>">
                                        <?php echo htmlspecialchars($genero->getNomGenero() ?? 'Género no disponible'); ?>
                                    </label>
                                <?php }; ?>
                            <?php }else{ ?>
                                <p>No hay géneros disponibles.</p>
                            <?php }; ?>
                        </div>

                        <button type="submit" name="accion" value="nuevo_libro">Guardar Libro</button>
                    </form>
                </div>

                <div id="form_borrar_autor" class="formulario-contenedor" style="display: none;">
                    <div>
                        <h2>Borrar Autor</h2>
                    </div>
                    <form action="../controlador/controladorAdmin.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este autor? Esta acción no se puede deshacer.');">
                        <div>
                            <label for="id_autor_a_borrar">Selecciona Autor a Borrar:</label>
                            <select id="id_autor_a_borrar" name="id_autor_a_borrar" required>
                                <option value="">-- Selecciona un autor --</option>
                                <?php foreach ($lista_autores as $autor){?>
                                    <option value="<?php echo $autor->getIdAutor(); ?>">
                                        <?php echo htmlspecialchars($autor->getNomAutor() ?? 'Nombre no disponible'); ?> (ID: <?php echo $autor->getIdAutor(); ?>)
                                    </option>
                                <?php };?>
                            </select>
                        </div>
                        <button type="submit" name="accion" value="borrar_autor">Borrar Autor Seleccionado</button>
                    </form>
                </div>

                <div id="form_borrar_libro" class="formulario-contenedor" style="display: none;">
                    <div>
                        <h2>Borrar Libro</h2>
                    </div>
                    <form action="../controlador/controladorAdmin.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este libro? Esta acción no se puede deshacer.');">
                        <div>
                            <label for="id_libro_a_borrar">Selecciona Libro a Borrar:</label>
                            <select id="id_libro_a_borrar" name="id_libro_a_borrar" required>
                                <option value="">-- Selecciona un libro --</option>
                                <?php foreach ($lista_libros as $libro){ ?>
                                    <option value="<?php echo $libro->getIdLibro(); ?>">
                                        <?php echo htmlspecialchars($libro->getTitulo() ?? 'Título no disponible'); ?> (ID: <?php echo $libro->getIdLibro(); ?>)
                                    </option>
                                <?php }; ?>
                            </select>
                        </div>
                        <button type="submit" name="accion" value="borrar_libro">Borrar Libro Seleccionado</button>
                    </form>
                </div>

            </div>
        </main>


    </div>
    
</body>

</html>