<?php
require_once 'models/Empleado.php';
require_once 'models/Departamento.php';

class EmpleadoController {
    public function index() {
        $modelo = new Empleado();
        $empleados = $modelo->getAll();
        include 'views/empleados/index.php';
    }

    public function create() {
        $departamentoModelo = new Departamento();
        $departamentos = $departamentoModelo->getAll();
        include 'views/empleados/create.php';
    }

    public function store() {
        $modelo = new Empleado();
        $modelo->create( $_POST[ 'nombre' ], $_POST[ 'email' ], $_POST[ 'departamento_id' ] );
        header( 'Location: index.php?controller=empleado&action=index' );
    }

    public function edit() {
        $modelo = new Empleado();
        $departamentoModelo = new Departamento();
        $empleado = $modelo->getById( $_GET[ 'id' ] );
        $departamentos = $departamentoModelo->getAll();
        include 'views/empleados/edit.php';
    }

    public function update() {
        $modelo = new Empleado();
        $modelo->update( $_POST[ 'id' ], $_POST[ 'nombre' ], $_POST[ 'email' ], $_POST[ 'departamento_id' ] );
        header( 'Location: index.php?controller=empleado&action=index' );
    }

    public function delete() {
        $modelo = new Empleado();
        $modelo->delete( $_GET[ 'id' ] );
        header( 'Location: index.php?controller=empleado&action=index' );
    }
}
