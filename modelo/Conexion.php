<?php

class Conexion {

    private $bd;
    private $host;
    private $usu;
    private $contra;
    private $conexion;

    public function __construct($bd, $host, $usu, $contra = "") {
        $this->bd = $bd;
        $this->host = $host;
        $this->usu = $usu;
        $this->contra = $contra;

        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->bd", "$this->usu", "$this->contra");
        } catch (Exception $e) {
            die("Error: ".$e->getMessage());
        }
    }
    
    public function getConexion() {
        return $this->conexion;
    }
    
}

