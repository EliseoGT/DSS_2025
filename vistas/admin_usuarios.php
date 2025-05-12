
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4">Panel de Administración de Usuarios</h1>

    <a href="bienvenida.php" class="btn btn-secondary mb-3">← Volver</a>
    <a href="roles.php" class="btn btn-primary mb-3">Roles</a>

    <!-- Buscador y selector -->
    <form method="GET" class="row mb-4">
        <div class="col-md-6 mb-2">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o email..." value="<?= htmlspecialchars($buscar) ?>">
        </div>
        <div class="col-md-3 mb-2">
            <select name="limite" class="form-select">
                <?php foreach ([5, 10, 25, 50] as $n): ?>
                    <option value="<?= $n ?>" <?= $limite == $n ? 'selected' : '' ?>>Mostrar <?= $n ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <button type="submit" class="btn btn-primary w-100">Aplicar</button>
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Cambiar Rol</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['rol_nombre'] ?? 'Sin rol') ?></td>
                <td>
                    <?php if ($usuario['id'] !== $_SESSION['usuario']['id']): ?>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="user_id" value="<?= $usuario['id'] ?>">
                            <select name="new_role_id" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                <?php foreach ($roles as $id => $nombre): ?>
                                    <option value="<?= $id ?>" <?= $usuario['rol_id'] == $id ? 'selected' : '' ?>><?= htmlspecialchars($nombre) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    <?php else: ?>
                        <em>No puedes cambiar tu propio rol</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <?php if ($totalPaginas > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $i === $pagina ? 'active' : '' ?>">
                        <a class="page-link" href="?buscar=<?= urlencode($buscar) ?>&limite=<?= $limite ?>&pagina=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
</body>
</html>