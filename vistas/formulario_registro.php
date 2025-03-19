<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Registro de Usuario</h1>
                        
                        <?php if (!empty($errores)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errores as $error): ?>
                                    <p class="mb-0"><?= htmlspecialchars($error) ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" 
                                    value="<?= htmlspecialchars($nombre) ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" 
                                    value="<?= htmlspecialchars($email) ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                 <label for="password" class="form-label">Contraseña:</label>
                                 <input type="password" class="form-control" name="password" id="password" required>
                                 <div class="form-text">Mínimo 8 caracteres con al menos una mayúscula y un número</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                        </form>
                        
                        <p class="text-center mt-3">¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none">Inicia Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>