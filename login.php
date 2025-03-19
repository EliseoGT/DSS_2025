<?php
require 'database.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido";
    if (empty($password)) $errores[] = "Contraseña requerida";

    if (empty($errores)) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email']
            ];
            header('Location: bienvenida.php');
            exit;
        } else {
            $errores[] = "Credenciales incorrectas";
        }
    }
}

include 'vistas/formulario_login.php';
?>