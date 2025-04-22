<?php
session_start();
require_once '../controlador/validaciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Libellus</title>
    <link rel="stylesheet" href="./css/login_registro.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <a href="../index.html"><img src="../img/logo_nom.png" alt="Libellus Logo"></a>
        </div>

        <?php 
        $mensaje=validarCadena(filter_input(INPUT_GET, "mensaje"));
        if ($mensaje){ ?>
            <div class="alerta"><?php echo $mensaje; ?></div>
        <?php }; ?>

        <div class="form">
            <h1>Iniciar Sesión</h1>
            <form action="../controlador/controladorLogin.php" method="POST">
                <div class="parteForm">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="parteForm">
                    <label for="contr">Contraseña:</label>
                    <input type="password" id="contr" name="contr" required>
                </div>
                <button type="submit" name="botonLogin" class="boton">Iniciar Sesión</button>
                <div class="link">
                    ¿No tienes cuenta? <a href="registro.php">Registrar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>