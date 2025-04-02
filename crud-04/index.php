<?php
// Menú simple al principio de la página
echo '<nav>
    <a href="index.php?controller=departamento&action=index">Departamentos</a> |
    <a href="index.php?controller=empleado&action=index">Empleados</a>
</nav><hr>';

// Controlador y acción por defecto
$controller = $_GET[ 'controller' ] ?? 'departamento';
$action = $_GET[ 'action' ] ?? 'index';

// Carga dinámica del controlador
require_once 'controllers/' . ucfirst( $controller ) . 'Controller.php';

$controllerClass = ucfirst( $controller ) . 'Controller';
$controllerInstance = new $controllerClass();
$controllerInstance->$action();