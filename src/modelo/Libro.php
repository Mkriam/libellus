<?php

require_once 'Conexion.php';
require_once '../controlador/validaciones.php';

class Libro
{

    private $id_libro;
    private $titulo;
    private $portada;
    private $sinopsis;
    private $fec_publicacion;
    private $url_compra;
    private $autores = [];
    private $generos = [];

    public function __construct( $titulo,  $sinopsis, $fec_publicacion, ?string $portada = null, ?string $url_compra = null, ?int $id_libro = null){

        $errores = [];

        if (!validarCadena($titulo)) {
            $errores[] = "El título del libro no es válido.";
        }

        

        if (!validarCadena($sinopsis)) {
            $errores[] = "La sinopsis del libro no es válida.";
        }
        

        $portadaValidada = null;
        if (!is_null($portada) && trim($portada) !== '') {
            if (!validarUrl($portada)) {
                $errores[] = "La URL de la portada no es válida.";
            } else {
                $portadaValidada = $portada;
            }
        }
        

        $urlCompraValidada = null;
        if (!is_null($url_compra) && trim($url_compra) !== '') {
            if (!validarUrl($url_compra)) {
                $errores[] = "La URL de compra no es válida.";
            } else {
                $urlCompraValidada = $url_compra;
            }
        }
        

        if (!empty($errores)) {
            throw new Exception(implode(" - ", $errores));
        }

        $this->titulo = $titulo;
        $this->sinopsis = $sinopsis;
        $this->id_libro = $id_libro;
        $this->portada = $portadaValidada;
        $this->fec_publicacion = $fec_publicacion;
        $this->url_compra = $urlCompraValidada;

        $this->autores = [];
        $this->generos = [];
    }

    // Getters
    public function getIdLibro()
    {
        return $this->id_libro;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getPortada()
    {
        return $this->portada;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function getFecPublicacion()
    {
        return $this->fec_publicacion;
    }

    public function getUrlCompra()
    {
        return $this->url_compra;
    }

    public function getAutores()
    {
        return $this->autores;
    }

    public function getGeneros()
    {
        return $this->generos;
    }

    // Setters
    public function setTitulo($titulo)
    {
        $this->titulo = validarCadena($titulo);
    }

    public function setPortada($portada)
    {
        $this->portada = validarUrl($portada);
    }

    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = validarCadena($sinopsis);
    }

    public function setFecPublicacion($fec_publicacion)
    {
        $this->fec_publicacion = validarFecha($fec_publicacion);
    }

    public function setUrlCompra($url_compra)
    {
        $this->url_compra = validarCadena($url_compra);
    }

    public function agregarAutor(Autor $autor)
    {
        $this->autores[] = $autor;
    }

    public function agregarGenero($id_genero)
    {
        if ($this->validarEnteroPositivo($id_genero)) {
            $this->generos[] = $id_genero;
        }
    }



    private function validarEnteroPositivo($valor)
    {
        return filter_var($valor, FILTER_VALIDATE_INT) !== false && $valor > 0;
    }


    public static function verLibro($id_libro)
    {
        $id_libro = validarCadena($id_libro);
        $salida = false;
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
            $con = $conexion->getConexion()->prepare("SELECT * FROM LIBRO WHERE id_libro = :id_libro");
            $con->bindParam(":id_libro", $id_libro);
            $con->execute();
            $datosLibro = $con->fetch(PDO::FETCH_ASSOC);

            if ($datosLibro) {
                $libro = new Libro(
                    $datosLibro['titulo'],
                    $datosLibro['sinopsis'],
                    $datosLibro['fec_publicacion'],
                    $datosLibro['portada'],
                    $datosLibro['url_compra'],
                    (int)$datosLibro['id_libro']
                );
                $libro->cargarAutores();
                $libro->cargarGeneros();
                $conexion->cerrarConexion();
                $salida = $libro;
            }
            $conexion->cerrarConexion();
        } catch (PDOException $e) {
            die("Error al buscar el libro: " . $e->getMessage());
        }
        return $salida;
    }

    public static function listarLibros(){
        $libros = [];
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");

            $sql = "SELECT id_libro, titulo, portada, sinopsis, fec_publicacion, url_compra 
                    FROM LIBRO 
                    ORDER BY titulo ASC"; 
            $con = $conexion->getConexion()->prepare($sql);
            $con->execute();
            $datosLibros = $con->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datosLibros as $datosLibro) {
                try {
                    $libro = new Libro(
                        $datosLibro['titulo'],
                        $datosLibro['sinopsis'],
                        $datosLibro['fec_publicacion'],
                        $datosLibro['portada'],
                        $datosLibro['url_compra'],
                        (int)$datosLibro['id_libro']
                    );
                    
                    $libros[] = $libro;

                } catch (Exception $e) {
                    die("Error instanciando el libro(ID: {$datosLibro['id_libro']}): " . $e->getMessage());
                }
            }

        } catch (PDOException $e) {
             die("Error en listarLibros: " . $e->getMessage());

        }
        $conexion->cerrarConexion();
        return $libros;
    }


    public function guardarLibro(){
        $salida=false;
        try {
            $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
            $con=$conexion->getConexion();
            if (Libro::verLibro($this->id_libro)) {
                $consulta = $conexion->getConexion()->prepare("UPDATE LIBRO SET titulo = :titulo, portada = :portada, sinopsis = :sinopsis, fec_publicacion = :fec_publicacion, url_compra = :url_compra WHERE id_libro = :id_libro");
                $consulta->bindParam(":id_libro", $this->id_libro);
            } else {
                $consulta = $conexion->getConexion()->prepare("INSERT INTO LIBRO (titulo, portada, sinopsis, fec_publicacion, url_compra) VALUES (:titulo, :portada, :sinopsis, :fec_publicacion, :url_compra)");
            }
            $consulta->bindParam(":titulo", $this->titulo);
            $consulta->bindParam(":portada", $this->portada);
            $consulta->bindParam(":sinopsis", $this->sinopsis);
            $consulta->bindParam(":fec_publicacion", $this->fec_publicacion);
            $consulta->bindParam(":url_compra", $this->url_compra);
            $consulta->execute();

            if (!$this->id_libro) {
                $this->id_libro = $con->lastInsertId();
            }

            $this->guardarAutores();
            $this->guardarGeneros();

            $salida=true;
            $conexion->cerrarConexion();
            
        } catch (PDOException $e) {
            die("Error al guardar el libro: " . $e->getMessage());
        }
        return $salida;
    }

    public static function eliminarLibro($id_libro)
    {
        $id_libro = validarCadena(filter_var($id_libro, FILTER_VALIDATE_INT));
        $salida = false;
        if (Libro::verLibro($id_libro)) {
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con = $conexion->getConexion()->prepare("DELETE FROM LIBRO WHERE id_libro = :id_libro");
                $con->bindParam(":id_libro", $id_libro);
                $con->execute();
                $conexion->cerrarConexion();
                if ($con->rowCount() > 0) {
                    $salida = true;
                     error_log("Libro ID {$id_libro} eliminado.");
                } else {
                     error_log("No se eliminó el libro ID {$id_libro}.");
                }
            } catch (PDOException $e) {
                die("Error al eliminar el libro: " . $e->getMessage());
            }
        }
        return $salida;
    }

    
    private function cargarAutores()
    {
        if ($this->id_libro) {
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con = $conexion->getConexion()->prepare("SELECT a.id_autor, a.nom_autor FROM AUTOR a JOIN ESCRIBE e ON a.id_autor = e.id_autor WHERE e.id_libro = :id_libro");
                $con->bindParam(":id_libro", $this->id_libro);
                $con->execute();
                $autoresDatos = $con->fetchAll(PDO::FETCH_ASSOC);
                foreach ($autoresDatos as $autorDatos) {
                    $this->agregarAutor(new Autor($autorDatos['nom_autor'], (int)$autorDatos['id_autor']));
                }
                $conexion->cerrarConexion();
            } catch (PDOException $e) {
                echo "Error al cargar los autores del libro: " . $e->getMessage();
            }
        }
    }

    // Método para agregar un autor al libro
    private function guardarAutores(){
        $salida=false;
        if ($this->id_libro) {
            $libroId = $this->id_libro; 
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con=$conexion->getConexion();
                // Eliminar relaciones existentes
                $conDelete = $con->prepare("DELETE FROM ESCRIBE WHERE id_libro = :id_libro");
                $conDelete->bindParam(":id_libro", $libroId);
                $conDelete->execute();
                // Insertar nuevas relaciones
                if (!empty($this->autores)) {
                    $insertAutor = $con->prepare("INSERT INTO ESCRIBE (id_libro, id_autor) VALUES (:id_libro, :id_autor)");
                    foreach ($this->autores as $autor) {
                        if ($autor instanceof Autor && $autor->getIdAutor()) { 
                            $idAutor = $autor->getIdAutor(); 
                            $insertAutor->bindParam(":id_libro", $libroId);
                            $insertAutor->bindValue(":id_autor", $idAutor); 
                            $insertAutor->execute();
                            $salida=true;
                        } else {
                            error_log("Intento de guardar relación ESCRIBE para Libro ID {$libroId} con autor inválido.");
                        }
                    }
                }
                $conexion->cerrarConexion();
            } catch (PDOException $e) {
                echo "Error al guardar los autores del libro: " . $e->getMessage();
            }
        }
        return $salida;
    }

    // Método para agregar un género al libro
    private function cargarGeneros()
    {
        if ($this->id_libro) {
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con = $conexion->getConexion()->prepare("SELECT g.id_genero FROM GENERO g JOIN POSEE p ON g.id_genero = p.id_genero WHERE p.id_libro = :id_libro");
                $con->bindParam(":id_libro", $this->id_libro);
                $con->execute();
                $generosData = $con->fetchAll(PDO::FETCH_COLUMN);
                $this->generos = $generosData;
                $conexion->cerrarConexion();
            } catch (PDOException $e) {
                echo "Error al cargar los géneros del libro: " . $e->getMessage();
            }
        }
    }

    private function guardarGeneros(){
        $salida=false;
        if ($this->id_libro) {
            $libroId = $this->id_libro;
            try {
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");
                $con=$conexion->getConexion();
                // Eliminar relaciones existentes
                $conDelete = $con->prepare("DELETE FROM POSEE WHERE id_libro = :id_libro");
                $conDelete->bindParam(":id_libro", $this->id_libro);
                $conDelete->execute();
                // Insertar nuevas relaciones
                if (!empty($this->generos)) {
                    $insertGenero = $con->prepare("INSERT INTO POSEE (id_libro, id_genero) VALUES (:id_libro, :id_genero)");
                    foreach ($this->generos as $id_genero) {
                        if ($this->validarEnteroPositivo($id_genero)) {
                            $insertGenero->bindParam(":id_libro", $libroId);
                            $insertGenero->bindValue(":id_genero", $id_genero);
                            $insertGenero->execute();
                            $salida=true;
                        } else {
                             error_log("Intento de guardar relación POSEE para Libro ID {$libroId} con genero inválido: " . $id_genero);
                        }
                    }
                }
                
                $conexion->cerrarConexion();
            } catch (PDOException $e) {
                echo "Error al guardar los géneros del libro: " . $e->getMessage();
            }
        }
        return $salida;
    }
}
