<?php
require 'database.php';

if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']['rol_id']) {
    header('Location: login.php');
    exit;
}

// Obtener permisos del rol actual
$stmt = $pdo->prepare("SELECT * FROM roles WHERE id = ?");
$stmt->execute([$_SESSION['usuario']['rol_id']]);
$mi_rol = $stmt->fetch();

if (!$mi_rol || !$mi_rol['puede_gestionar_roles']) {
    echo "Acceso denegado.";
    exit;
}

// Busqueda y paginación
$buscar = $_GET['buscar'] ?? '';
$limite = isset($_GET['limite']) ? (int)$_GET['limite'] : 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $limite;

$where = '';
$params = [];

if ($buscar) {
    $where = "WHERE u.nombre LIKE ? OR u.email LIKE ?";
    $params = ["%$buscar%", "%$buscar%"];
}

$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios u $where");
$totalStmt->execute($params);
$totalRegistros = $totalStmt->fetchColumn();
$totalPaginas = ceil($totalRegistros / $limite);

// Obtener usuarios con roles
$stmt = $pdo->prepare("
    SELECT u.id, u.nombre, u.email, r.nombre AS rol_nombre, u.rol_id
    FROM usuarios u
    LEFT JOIN roles r ON u.rol_id = r.id
    $where
    ORDER BY u.id ASC
    LIMIT $limite OFFSET $offset
");
$stmt->execute($params);
$usuarios = $stmt->fetchAll();

// Obtener todos los roles
$roles = $pdo->query("SELECT id, nombre FROM roles")->fetchAll(PDO::FETCH_KEY_PAIR);

// Cambiar rol
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_role_id'])) {
    $userId = (int)$_POST['user_id'];
    $newRoleId = (int)$_POST['new_role_id'];

    // No permitir que un usuario cambie su propio rol
    if ($userId !== $_SESSION['usuario']['id']) {
        $update = $pdo->prepare("UPDATE usuarios SET rol_id = ? WHERE id = ?");
        $update->execute([$newRoleId, $userId]);
        header("Location: admin.php");
    }
}
include 'vistas\admin_usuarios.php'
?>