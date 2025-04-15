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
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="login">
        <div class="logo">
            <a href="../index.html"><img src="../img/logo_nom.png" alt="Libellus Logo"></a>
        </div>

        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alerta"><?php echo validarCadena($_GET['mensaje']); ?></div>
        <?php endif; ?>

        <div class="formLogin">
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
                <button type="submit" name="botonLogin" class="botonLogin">Iniciar Sesión</button>
                <div class="linkRegistrar">
                    ¿No tienes cuenta? <a href="registro.php">Registrar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>