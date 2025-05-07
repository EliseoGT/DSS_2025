<?php
require 'database.php';
require 'auth.php';
verificarRol('admin');

// Cambiar rol si se recibe POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_role'])) {
    $userId = intval($_POST['user_id']);
    $newRole = $_POST['new_role'] === 'admin' ? 'admin' : 'usuario';

    if ($userId !== $_SESSION['usuario']['id']) {
        $stmt = $pdo->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
        $stmt->execute([$newRole, $userId]);
    }

    header("Location: admin.php");
    exit;
}

// ===============================
// FILTROS Y PAGINACIÓN
// ===============================
$buscar = $_GET['buscar'] ?? '';
$limite = isset($_GET['limite']) ? intval($_GET['limite']) : 10;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;

$limite = in_array($limite, [5, 10, 25, 50]) ? $limite : 10;
$offset = ($pagina - 1) * $limite;

// Contar total de resultados para paginación
$paramBuscar = "%$buscar%";
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre LIKE ? OR email LIKE ?");
$totalStmt->execute([$paramBuscar, $paramBuscar]);
$totalUsuarios = $totalStmt->fetchColumn();
$totalPaginas = ceil($totalUsuarios / $limite);

// Consultar usuarios filtrados
$stmt = $pdo->prepare("SELECT id, nombre, email, rol FROM usuarios 
    WHERE nombre LIKE ? OR email LIKE ?
    ORDER BY id ASC
    LIMIT ? OFFSET ?");
$stmt->execute([$paramBuscar, $paramBuscar, $limite, $offset]);
$usuarios = $stmt->fetchAll();

// Mostrar vista
include 'vistas/admin_usuarios.php';
