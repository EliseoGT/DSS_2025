<?php
function verificarRol($rolPermitido) {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== $rolPermitido) {
        header('Location: login.php');
        exit;
    }
}

// Para múltiples roles permitidos
function verificarRoles(array $rolesPermitidos) {
    if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
        header('Location: login.php');
        exit;
    }
}
