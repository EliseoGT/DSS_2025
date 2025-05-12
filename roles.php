<?php
require 'database.php';
require 'auth.php';
verificarPermiso($pdo, 'puede_gestionar_roles');

// Crear nuevo rol
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $puede_leer = isset($_POST['puede_leer']) ? 1 : 0;
    $puede_escribir = isset($_POST['puede_escribir']) ? 1 : 0;
    $puede_crear = isset($_POST['puede_crear']) ? 1 : 0;
    $puede_borrar = isset($_POST['puede_borrar']) ? 1 : 0;
    $puede_gestionar_roles = isset($_POST['puede_gestionar_roles']) ? 1 : 0;

    if (!empty($nombre)) {
        $stmt = $pdo->prepare("INSERT INTO roles (nombre, puede_leer, puede_escribir, puede_crear, puede_borrar, puede_gestionar_roles)
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $puede_leer, $puede_escribir, $puede_crear, $puede_borrar, $puede_gestionar_roles]);
        header("Location: roles.php");
        exit;
    }
}

// Obtener todos los roles
$roles = $pdo->query("SELECT * FROM roles ORDER BY id ASC")->fetchAll();

include 'vistas\roles_vista.php'
?>