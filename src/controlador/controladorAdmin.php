<?php

session_start();

require_once '../modelo/Conexion.php';
require_once '../modelo/Autor.php';
require_once '../modelo/Libro.php';
require_once '../modelo/Genero.php';
require_once 'validaciones.php';


$redirect_url = '../vistas/areaAdmin.php';



if (filter_has_var(INPUT_POST, "accion")) {
    $accion = validarCadena(filter_input(INPUT_POST, 'accion'));

    try {
        switch ($accion) {
            case 'nuevo_autor':
                $nom_autor = validarCadena(filter_input(INPUT_POST, 'nom_autor'));
                
                $autor = new Autor($nom_autor);
                if ($autor->guardarAutor()) {
                    $_SESSION['mensaje_exito'] = "El autor '$nom_autor' se ha guardado correctamente.";
                } else {
                    $_SESSION['mensaje_error'] = "No se pudo guardar el autor (el nombre introducido puede que ya exista).";
                }
                break;
    
            case 'nuevo_libro':
                
                $titulo = validarCadena(filter_input(INPUT_POST, 'titulo'));
                $portada = empty(validarUrl(filter_input(INPUT_POST, 'portada'))) ? null : validarUrl(filter_input(INPUT_POST, 'portada'));
                $sinopsis = validarCadena(filter_input(INPUT_POST, 'sinopsis'));
                $fec_publicacion = validarFecha(filter_input(INPUT_POST, 'fec_publicacion'));
                $url_compra = empty(validarUrl(filter_input(INPUT_POST, 'url_compra'))) ? null : validarUrl(filter_input(INPUT_POST, 'url_compra'));
                $ids_autores = $_POST['autores'] ?? [];
                $ids_generos = $_POST['generos'] ?? [];
    
                $libro = new Libro($titulo, $sinopsis, $fec_publicacion, $portada, $url_compra, null);
    
                
                foreach ($ids_autores as $id_autor) {
                    if (filter_var($id_autor, FILTER_VALIDATE_INT)) {
                        $autor_obj = Autor::verAutor((int)$id_autor);
                        if ($autor_obj) $libro->agregarAutor($autor_obj);
                    }
                }
    
                foreach ($ids_generos as $id_genero) {
                    if (filter_var($id_genero, FILTER_VALIDATE_INT)) {
                        $libro->agregarGenero((int)$id_genero);
                    }
                }
    
                if ($libro->guardarLibro()) {
                    $_SESSION['mensaje_exito'] = "El libro '$titulo' se ha guardado correctamente.";
                } else {
                    $_SESSION['mensaje_error'] = "No se pudo guardar el libro.";
                }
                break;
    
            case 'borrar_autor':
                $id_autor_a_borrar = validarCadena(filter_input(INPUT_POST, 'id_autor_a_borrar'));
                if (filter_var($id_autor_a_borrar, FILTER_VALIDATE_INT) && $id_autor_a_borrar > 0) {
                    if (Autor::eliminarAutor((int)$id_autor_a_borrar)) {
                        $_SESSION['mensaje_exito'] = "Autor eliminado correctamente.";
                    } else {
                        $_SESSION['mensaje_error'] = "No se pudo eliminar el autor con ID: $id_autor_a_borrar.";
                    }
                } else {
                    $_SESSION['mensaje_error'] = "ID de autor no válida.";
                }
                break;
    
            case 'borrar_libro':
                $id_libro_a_borrar = validarCadena(filter_input(INPUT_POST, 'id_libro_a_borrar'));
                if (filter_var($id_libro_a_borrar, FILTER_VALIDATE_INT) && $id_libro_a_borrar > 0) {
                    if (Libro::eliminarLibro((int)$id_libro_a_borrar)) {
                        $_SESSION['mensaje_exito'] = "Libro eliminado correctamente.";
                    } else {
                        $_SESSION['mensaje_error'] = "No se pudo eliminar el libro con ID: $id_libro_a_borrar.";
                    }
                } else {
                    $_SESSION['mensaje_error'] = "ID de libro no válida.";
                }
                break;
    
            default:
                 $_SESSION['mensaje_error'] = "Acción desconocida.";
                break;
        }
    } catch (Exception $e) {
        $_SESSION['mensaje_error'] = "Error: " . $e->getMessage();
    }

}




header("Location: " . $redirect_url);
exit();

?>