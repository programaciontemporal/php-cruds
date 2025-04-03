<?php
// Valores recibidos del controlador
$error = $error ?? null;
$username_value = $username_value ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventario</title>
    <!-- Bootstrap Theme y estilos propios -->
    <link href="/cruds/crud-06/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cruds/crud-06/assets/css/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/cruds/crud-06/assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex vh-100 justify-content-center align-items-center">
    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card shadow-sm">
            <div class="card-body p-4 p-sm-5">
                <div class="mb-4 text-center">
                    <i class="bi bi-box-seam display-4 text-white mb-3"></i>
                    <h2 class="h4">Sistema de Inventario</h2>
                </div>

                <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form id="loginForm" method="POST" action="index.php?controller=Auth&action=login"
                    class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control rounded" id="username" name="username" required minlength="4"
                                maxlength="20" pattern="[a-zA-Z0-9]+" value="<?= $username_value ?>">
                        </div>
                        <div class="invalid-feedback">
                            Usuario debe tener 4-20 caracteres alfanuméricos
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control rounded" id="password" name="password" required
                                minlength="8" maxlength="20">
                        </div>
                        <div class="invalid-feedback">
                            Contraseña debe tener 8-20 caracteres
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mt-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Acceder
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Validación de formulario
    (function() {
        'use strict';

        const form = document.getElementById('loginForm');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    })();
    </script>
</body>

</html>