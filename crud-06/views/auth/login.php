<?php ob_start(); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="bi bi-box-arrow-in-right"></i> Acceso al Sistema</h3>
                </div>
                <div class="card-body">
                    <form action="index.php?controller=Auth&action=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" id="username" name="username" required
                                    autofocus>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Sistema de Inventario</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();

// Versión autónoma con todos los estilos incluidos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventario</title>
    <!-- Bootstrap Slate Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background-color: #2b3e50;
        height: 100vh;
        padding-top: 0;
    }

    .login-container {
        max-width: 400px;
        margin: 0 auto;
    }

    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3);
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .input-group-text {
        background-color: #4e5d6c;
        border: 1px solid #4e5d6c;
        color: #ebebeb;
    }

    .form-control {
        background-color: #4e5d6c;
        border: 1px solid #4e5d6c;
        color: #fff;
    }

    .form-control:focus {
        background-color: #4e5d6c;
        color: #fff;
        border-color: #5b6b7c;
        box-shadow: 0 0 0 0.25rem rgba(72, 85, 99, 0.25);
    }
    </style>
</head>

<body>
    <?= $content ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>