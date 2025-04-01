<?php
require_once __DIR__ . '/app/controllers/TareaController.php';

// Manejo de acciones
$action = $_GET['action'] ?? 'index';

$controller = new TareaController();

// Validar y ejecutar acción
$allowedActions = ['index', 'crear', 'guardar', 'editar', 'actualizar', 'eliminar'];
if (in_array($action, $allowedActions)) {
    $controller->{$action}();
} else {
    // Acción no válida, redirigir al índice
    header('Location: index.php?action=index');
    exit();
}
?>