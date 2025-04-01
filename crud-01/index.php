<?php
// Establecer valores por defecto
$modulo = isset($_GET['modulo']) ? strtolower($_GET['modulo']) : 'cliente';
$accion = isset($_GET['accion']) ? strtolower($_GET['accion']) : 'index';

// Cargar el controlador adecuado
switch($modulo) {
    case 'producto':
        require_once __DIR__ . '/app/controllers/ProductoController.php';
        $controller = new ProductoController();
        break;
    case 'cliente':
    default:
        require_once __DIR__ . '/app/controllers/ClienteController.php';
        $controller = new ClienteController();
        break;
}

// Ejecutar la acción correspondiente
switch($accion) {
    case 'create':
        $controller->create();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
?>