
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestión de Roles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Roles</h1>
        <a href="admin.php" class="btn btn-secondary mb-3">← Volver</a>

        <form method="POST" class="card p-4 mb-4">
            <h4>Crear Nuevo Rol</h4>
            <div class="mb-3">
                <label class="form-label">Nombre del Rol</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-check"><input class="form-check-input" type="checkbox" name="puede_leer" id="leer"><label class="form-check-label" for="leer">Puede Leer</label></div>
            <div class="form-check"><input class="form-check-input" type="checkbox" name="puede_escribir" id="escribir"><label class="form-check-label" for="escribir">Puede Escribir</label></div>
            <div class="form-check"><input class="form-check-input" type="checkbox" name="puede_crear" id="crear"><label class="form-check-label" for="crear">Puede Crear</label></div>
            <div class="form-check"><input class="form-check-input" type="checkbox" name="puede_borrar" id="borrar"><label class="form-check-label" for="borrar">Puede Borrar</label></div>
            <div class="form-check"><input class="form-check-input" type="checkbox" name="puede_gestionar_roles" id="gestionar"><label class="form-check-label" for="gestionar">Puede Gestionar Roles</label></div>
            <button type="submit" class="btn btn-primary mt-3">Crear Rol</button>
        </form>

        <h4>Roles Existentes</h4>
        <table class="table table-bordered bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Leer</th>
                    <th>Escribir</th>
                    <th>Crear</th>
                    <th>Borrar</th>
                    <th>Gestionar Roles</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?= $rol['id'] ?></td>
                    <td><?= htmlspecialchars($rol['nombre']) ?></td>
                    <td><?= $rol['puede_leer'] ? '✅' : '❌' ?></td>
                    <td><?= $rol['puede_escribir'] ? '✅' : '❌' ?></td>
                    <td><?= $rol['puede_crear'] ? '✅' : '❌' ?></td>
                    <td><?= $rol['puede_borrar'] ? '✅' : '❌' ?></td>
                    <td><?= $rol['puede_gestionar_roles'] ? '✅' : '❌' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </body>
</html>