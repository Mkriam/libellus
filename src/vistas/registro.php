<?php
require_once '../controlador/validaciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Libellus</title>
    <link rel="stylesheet" href="./css/login_registro.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <a href="../index.html"><img src="../img/logo_nom.png" alt="Logo Libellus"></a>
        </div>
        <div class="form">
            <h1>Crear Cuenta</h1>

            <!-- Mostrar mensajes de error o de éxito -->
            <?php 
            $mensaje=validarCadena(filter_input(INPUT_GET, "mensaje"));
            if ($mensaje){ ?>
                <div class="alerta"><?php echo $mensaje; ?></div>
            <?php }; ?>

            <form action="../controlador/controladorRegistro.php" method="POST">
                <div class="parteForm">
                    <label for="nombre">Nombre usuario:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="parteForm">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="parteForm">
                    <label for="contr">Contraseña:</label>
                    <input type="password" id="contr" name="contr" required>
                </div>
                <div class="parteForm">
                    <label for="confirmarContr">Confirmar Contraseña:</label>
                    <input type="password" id="confirmarContr" name="confirmarContr" required>
                </div>
                <button type="submit" class="boton" name="botonRegistro">Registrarse</button>
                <div class="link">
                    ¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
