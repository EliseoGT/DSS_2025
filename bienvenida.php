<?php
require 'database.php';
require 'auth.php';

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }

    $nombre = htmlspecialchars($_SESSION['usuario']['nombre']);
    $permisos = obtenerPermisos($pdo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center">
        <div class="card shadow-lg p-4 rounded-4">
            <div class="card-body">
                <h1 class="display-5 mb-3">¡Hola, <span class="text-primary"><?= $nombre ?></span>!</h1>
                <p class="lead">Has iniciado sesión correctamente.</p>
                <hr class="my-4">

                <?php if (!empty($permisos['puede_gestionar_roles'])): ?>
                    <a href="admin.php" class="btn btn-outline-primary btn-lg mb-3">Ir al Panel de Administración</a><br>
                <?php endif; ?>

                <a href="logout.php" class="btn btn-danger btn-lg">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
