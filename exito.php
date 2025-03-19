<?php
session_start();
if (!isset($_SESSION['exito'])) {
    header('Location: registro.php');
    exit;
}
unset($_SESSION['exito']);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="exito">
        <h2>¡Registro exitoso!</h2>
        <p>Ahora puedes <a href="registro.php">iniciar sesión</a></p>
    </div>
</body>
</html>