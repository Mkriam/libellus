<?php
require_once '../modelo/Conexion.php';
require_once '../controlador/validaciones.php';

if (filter_has_var(INPUT_POST, "botonRegistro")) {
    $nombre = validarUsu(filter_input(INPUT_POST, 'nombre'));
    $email = validarEmail(filter_input(INPUT_POST, 'email'));
    $contr = validarContr(filter_input(INPUT_POST, 'contr'));
    $confirmarContr = validarContr(filter_input(INPUT_POST, 'confirmarContr'));

    // Validaciones de campos
    if ($nombre && $email && $contr && $confirmarContr) {
        if ($contr === $confirmarContr) {
            try {
                // Conexión a la base de datos
                $conexion = new Conexion("libellus", "db", "miriam", "libreria123");

                // Verificar si el nombre de usuario o el correo ya están registrados
                $consulta = $conexion->getConexion()->prepare("SELECT nom_usu FROM USUARIO WHERE nom_usu = :nombre OR email = :email");
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':email', $email);
                $consulta->execute();
        
                // Verificar si ya existe el usuario, si es así lo redirijo a login
                if ($consulta->rowCount() > 0) {
                    header("Location: ../vistas/registro.php?mensaje=" . urlencode("El nombre de usuario o el correo ya están registrados."));
                    exit();
                }
        
                $hashedPassword = password_hash($contr, PASSWORD_DEFAULT);

                $insertar = $conexion->getConexion()->prepare("INSERT INTO USUARIO (nom_usu, email, clave_usu) VALUES (:nombre, :email, :contra)");
                $insertar->bindParam(':nombre', $nombre);
                $insertar->bindParam(':email', $email);
                $insertar->bindParam(':contra', $hashedPassword);
        
                if ($insertar->execute()) {
                    header("Location: ../vistas/login.php?mensaje=" . urlencode("Usuario registrado exitosamente. Por favor, inicia sesión."));
                    exit();
                } else {
                    $mensaje="Error al registrar el usuario. Inténtelo de nuevo más tarde.";
                }
            } catch (Exception $ex) {
                $mensaje="Error en la base de datos: " . $ex->getMessage();
            }
        }else{
            $mensaje="Las contraseñas no coinciden.";
        }
    }else{
        $mensaje="Por favor, complete todos los campos. ";
        
    }
    
    header("Location: ../vistas/registro.php?mensaje=" . urlencode($mensaje));
    exit();

}
