<?php

require_once 'Conexion.php';
require_once '../controlador/validaciones.php';

class Autor
{

    private $id_autor;
    private $nom_autor;

    public function __construct($nom_autor, ?int $id_autor = null)
    {

        $error = "";
        if (!validarCadena($nom_autor)) {
            $error = "El nombre del autor no es válido o está vacío.";
        }

        if (!empty($error)) {
            throw new Exception($error);
        }

        $this->id_autor = $id_autor;
        $this->nom_autor = validarCadena($nom_autor);
    }

    // Getters
    public function getIdAutor()
    {
        return $this->id_autor;
    }

    public function getNomAutor()
    {
        return $this->nom_autor;
    }

    // Setters
    public function setNomAutor($nom_autor)
    {
        $salida = false;
        $nombreValidado = validarCadena($nom_autor);
        if ($nombreValidado) {
            $this->nom_autor = $nombreValidado;
            $salida = true;
        }
        return $salida;
    }


    public static function verAutor($id_autor)
    {
        $id_autor = validarCadena($id_autor);
        $autor_objeto = null;

        if ($id_autor) {
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con = $conexion->getConexion()->prepare("SELECT * FROM AUTOR WHERE id_autor = :id_autor");
                $con->bindParam(":id_autor", $id_autor, PDO::PARAM_INT);
                $con->execute();
                $datosAutor = $con->fetch(PDO::FETCH_ASSOC);
                $conexion->cerrarConexion();

                if ($datosAutor) {
                    try {
                        $autor_objeto = new Autor($datosAutor['nom_autor'], (int)$datosAutor['id_autor']);
                    } catch (Exception $e) {
                        die("Error al buscar al autor: " . $e->getMessage());
                    }
                }
            } catch (PDOException $e) {
                die("Error al buscar al autor: " . $e->getMessage());
            }
        }
        return $autor_objeto;
    }

    public static function listarAutores()
    {
        $autores = [];
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
            $con = $conexion->getConexion()->prepare("SELECT * FROM AUTOR ORDER BY nom_autor ASC");
            $con->execute();
            $datosAutores = $con->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datosAutores as $datosAutor) {
                $autores[] = new Autor($datosAutor['nom_autor'], (int)$datosAutor['id_autor']);
            }
            $conexion->cerrarConexion();
        } catch (PDOException $e) {
            die("Error al listar los autores: " . $e->getMessage());
        }
        return $autores;
    }

    public function guardarAutor()
    {
        $salida = false;
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
            $con = $conexion->getConexion();

            $busqueda = $con->prepare("SELECT * FROM AUTOR WHERE nom_autor = :nom_autor");
            $busqueda->bindParam(":nom_autor", $this->nom_autor);
            $busqueda->execute();
            $autorExistente = $busqueda->fetch(PDO::FETCH_ASSOC);

            if ($autorExistente) {
                throw new Exception("Ya existe un autor con ese nombre.");
            }

            if (Autor::verAutor($this->id_autor)) {
                $con = $conexion->getConexion()->prepare("UPDATE AUTOR SET nom_autor = :nom_autor WHERE id_autor = :id_autor");
                $con->bindParam(":id_autor", $this->id_autor);
            } else {
                $con = $conexion->getConexion()->prepare("INSERT INTO AUTOR (nom_autor) VALUES (:nom_autor)");
            }
            $con->bindParam(":nom_autor", $this->nom_autor);
            $con->execute();
            $conexion->cerrarConexion();
            $salida=true;
        } catch (PDOException $e) {
            die("Error al guardar el autor: " . $e->getMessage());
        }
        return $salida;
    }

    public static function eliminarAutor($id_autor)
    {
        $id_autor = validarCadena(filter_var($id_autor, FILTER_VALIDATE_INT));
        $salida = false;
        if ($id_autor && $id_autor > 0) {
            if (Autor::verAutor($id_autor)) {
                try {
                    $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                    $con = $conexion->getConexion();
                    $con->beginTransaction();

                    $comprobacion = $con->prepare("SELECT COUNT(*) FROM ESCRIBE WHERE id_autor = :id_autor");
                    $comprobacion->bindParam(":id_autor", $id_autor, PDO::PARAM_INT);
                    $comprobacion->execute();
                    $numLibros = $comprobacion->fetchColumn();

                    if ($numLibros == 0) {
                        $borrarAutor=$con->prepare("DELETE FROM AUTOR WHERE id_autor = :id_autor");
                        $borrarAutor->bindParam(":id_autor", $id_autor);
                        $borrarAutor->execute();
                        $conexion->cerrarConexion();

                        if ($borrarAutor->rowCount() > 0) {
                            $con->commit();
                            $salida = true;
                            error_log("Autor ID {$id_autor} eliminado correctamente.");
                        } else {
                             $con->rollBack();
                             error_log("Error al eliminar autor ID {$id_autor}: No se encontró o no se pudo eliminar.");
                        }
                    } else {
                        error_log("No se pudo eliminar al autor con ID {$id_autor}: El autor está asociado a {$numLibros} libro(s).");
                    }
                } catch (PDOException $e) {
                    die("Error al eliminar el autor: " . $e->getMessage());
                }
            }
        }
        return $salida;
    }
}
