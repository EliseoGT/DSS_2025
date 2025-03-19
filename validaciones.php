<?php
$nombre = filter_var($_POST['nombre'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$errores = [];

// Validaciones 
if (empty($nombre)) $errores[] = "El nombre es requerido";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido";
if (strlen($password) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres";
} else {
    if (!preg_match('/[A-Z]/', $password)) $errores[] = "Falta una mayúscula";
    if (!preg_match('/\d/', $password)) $errores[] = "Falta un número";
}
if ($password !== $confirm_password) $errores[] = "Contraseñas no coinciden";
?>