<?php
require_once __DIR__ . '/app/controllers/LibroController.php';

// Manejo de acciones
$action = $_GET['action'] ?? 'index';

$controller = new LibroController();

// Validar y ejecutar acción
$allowedActions = [
    'index',       // Listar libros
    'crear',       // Mostrar formulario de creación
    'guardar',     // Procesar formulario de creación
    'editar',      // Mostrar formulario de edición
    'actualizar',  // Procesar formulario de edición
    'eliminar',    // Eliminar un libro
    'buscar'       // Búsqueda de libros
];

if (in_array($action, $allowedActions)) {
    $controller->{$action}();
} else {
    // Acción no válida, redirigir al índice
    header('Location: index.php?action=index');
    exit();
}
?>