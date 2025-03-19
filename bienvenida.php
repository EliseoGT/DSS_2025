<?php
require 'database.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$nombre = htmlspecialchars($_SESSION['usuario']['nombre']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>¡Bienvenido, <?= $nombre ?>!</h1>
        <a href="logout.php" class="btn">Cerrar Sesión</a>
    </div>
</body>
</html>