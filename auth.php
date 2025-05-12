<?php
function obtenerPermisos($pdo) {
    if (!isset($_SESSION['usuario']['rol_id'])) return [];

    $stmt = $pdo->prepare("SELECT * FROM roles WHERE id = ?");
    $stmt->execute([$_SESSION['usuario']['rol_id']]);
    return $stmt->fetch() ?: [];
}

function verificarPermiso($pdo, $permiso) {
    $permisos = obtenerPermisos($pdo);
    if (empty($permisos[$permiso]) || !$permisos[$permiso]) {
        header('Location: login.php');
        exit;
    }
}
?>