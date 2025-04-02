<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;
    
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }
    
    public function login() {
        // Verificar si ya está logueado
        if ($this->usuarioModel->estaAutenticado()) {
            header('Location: index.php');
            exit;
        }

        $error = null;
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            
            if (!empty($username) && !empty($password)) {
                $usuario = $this->usuarioModel->obtenerPorUsername($username);
                
                if ($usuario && $this->usuarioModel->verificarPassword($password, $usuario['password_hash'])) {
                    if ($this->usuarioModel->iniciarSesion($usuario)) {
                        header('Location: index.php');
                        exit;
                    } else {
                        $error = "Error al iniciar sesión";
                    }
                } else {
                    $error = "Usuario o contraseña incorrectos";
                }
            } else {
                $error = "Debe completar ambos campos";
            }
        }
        
        // Mostrar vista de login
        $this->mostrarLogin($error);
    }
    
    private function mostrarLogin($error = null) {
        // Vista autónoma con todo el HTML necesario
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventario</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background-color: #2b3e50;
        height: 100vh;
        display: flex;
        align-items: center;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-card">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="bi bi-box-arrow-in-right"></i> Acceso al Sistema</h3>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form action="index.php?controller=Auth&action=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
        exit;
    }
    
    public function logout() {
        $this->usuarioModel->cerrarSesion();
        header('Location: index.php?controller=Auth&action=login');
        exit;
    }
}