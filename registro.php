<?php
require 'database.php';

$errores = [];
$nombre = $email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validaciones
    if (empty($nombre)) $errores[] = "Nombre requerido";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido";
    if (strlen($password) < 8) $errores[] = "La contraseña debe tener al menos 8 caracteres";
    if ($password !== $confirm_password) $errores[] = "Las contraseñas no coinciden";
    // Validaciones de contraseña
    if (strlen($password) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres";
    } else {
        if (!preg_match('/[A-Z]/', $password)) {
            $errores[] = "La contraseña debe contener al menos una letra mayúscula";
        }
        if (!preg_match('/\d/', $password)) {
            $errores[] = "La contraseña debe contener al menos un número";
        }
    }

    if (empty($errores)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $email, password_hash($password, PASSWORD_DEFAULT), 'usuario']);
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $errores[] = ($e->errorInfo[1] == 1062) ? "El email ya está registrado" : "Error al registrar";
        }
    }
}

include 'vistas/formulario_registro.php';
?>