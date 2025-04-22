<?php
// En: modelo/Genero.php (Ajusta la ruta si es necesario)

require_once 'Conexion.php';
require_once '../controlador/validaciones.php';

class Genero {
    private $id_genero;
    private $nom_genero;

    public function __construct($nom_genero, ?int $id_genero = null) {
        $nombreValidado = validarCadena($nom_genero);
        if ($nombreValidado === false) {
            throw new Exception("Nombre de género inválido.");
        }
        $this->id_genero = $id_genero;
        $this->nom_genero = $nombreValidado;
    }

    // Getters
    public function getIdGenero(): ?int {
        return $this->id_genero;
    }
    public function getNomGenero(): ?string {
        return $this->nom_genero;
    }

    public static function listarGeneros(): array {
        $generos = [];
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
            $con = $conexion->getConexion()->prepare("SELECT id_genero, nom_genero FROM GENERO ORDER BY nom_genero ASC");
            $con->execute();
            $datosGeneros = $con->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datosGeneros as $dato) {
                $generos[] = new Genero($dato['nom_genero'], (int)$dato['id_genero']); 
            }
            $conexion->cerrarConexion();
        } catch (PDOException $e) {
            die("Error al listar los géneros: " . $e->getMessage());
        }
        return $generos;
    }
}
?>