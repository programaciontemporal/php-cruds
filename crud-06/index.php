<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Autocargar clases
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
    
    throw new Exception("Clase $class no encontrada");
});

// Manejo de errores
set_exception_handler(function ($exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    echo "Error interno del servidor";
    exit;
});

// Rutas públicas (no requieren autenticación)
$publicRoutes = [
    'Auth' => ['login']
];

// Obtener controlador y acción
$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'login';

// Verificar autenticación
$usuarioModel = new Usuario();
if (!$usuarioModel->estaAutenticado() && !($publicRoutes[$controller] ?? false && in_array($action, $publicRoutes[$controller]))) {
    header('Location: index.php?controller=Auth&action=login');
    exit;
}

// Validar y crear instancia del controlador
$controllerClass = $controller . 'Controller';
if (!class_exists($controllerClass)) {
    http_response_code(404);
    die('Controlador no encontrado');
}

try {
    $controllerInstance = new $controllerClass();

    // Validar y llamar a la acción
    if (!method_exists($controllerInstance, $action)) {
        http_response_code(404);
        die('Acción no encontrada');
    }

    // Manejar parámetros
    $params = array_filter($_GET, function($key) {
        return !in_array($key, ['controller', 'action']);
    }, ARRAY_FILTER_USE_KEY);

    // Llamar a la acción
    call_user_func_array([$controllerInstance, $action], $params);
} catch (PDOException $e) {
    error_log("Error de base de datos: " . $e->getMessage());
    $_SESSION['message'] = 'Error de base de datos';
    $_SESSION['message_type'] = 'danger';
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log("Error general: " . $e->getMessage());
    http_response_code(500);
    echo "Error interno del servidor";
    exit;
}