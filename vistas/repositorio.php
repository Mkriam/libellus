<?php
require_once '../modelo/Conexion.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Configura los datos de conexión
//$conexion = new Conexion("libreria_db", "db", "root", "rootlib"); 

$conexion = new Conexion("libreria_db", "db", "miriam", "libreria123");


try {
    $pdo = $conexion->getConexion();
    $stmt = $pdo->prepare("SELECT * FROM books WHERE user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->execute([$_SESSION['user']]);
    $books = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Error al cargar los libros: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Biblioteca - Libellus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
        <h3>Tus libros guardados:</h3>
        <ul>
            <?php foreach ($books as $book): ?>
                <li><?php echo htmlspecialchars($book['title']); ?> - <?php echo htmlspecialchars($book['author']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="add_book.php" class="btn btn-success mt-3">Añadir Libro</a>
    </div>
</body>
</html>
