<?php
session_start();
require_once '../modelo/Conexion.php';
require_once 'validaciones.php';

$conexion = new Conexion("libellus", "db", "miriam", "libreria123");

if (filter_has_var(INPUT_POST, "botonLogin")) {
    $email = validarEmail(filter_input(INPUT_POST, 'email'));
    $contr = validarContr(filter_input(INPUT_POST, 'contr'));

    if ($email && $contr) {
        try {
            // Consulta a la base de datos para obtener la contraseña y el rol
            $con = $conexion->getConexion()->prepare("SELECT clave_usu, nom_usu, administrador FROM USUARIO WHERE email = :email");
            $con->bindParam(":email", $email);
            $con->execute();
            $datosUsu = $con->fetch(PDO::FETCH_ASSOC);

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($datosUsu && password_verify($contr, $datosUsu['clave_usu'])) {
                $_SESSION['usuario'] = $datosUsu['nom_usu'];
                $_SESSION['administrador'] = $datosUsu['administrador'];

                // Redireccionar según el rol
                if ($datosUsu['administrador']) {
                    header("Location: ../vistas/areaAdmin.php");
                } else {
                    header("Location: ../vistas/areaUsuario.php");
                }
                exit();
            } else {
                $mensaje = "El usuario o la contraseña no son correctos.";
            }
        } catch (Exception $e) {
            $mensaje = "Error al consultar la base de datos: " . $e->getMessage();
        }
    } else {
        $mensaje = "No ha introducido los datos requeridos o no son válidos.";
    }

    // Redireccionar a la página de login con el mensaje de error
    header("Location: ../vistas/login.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>
