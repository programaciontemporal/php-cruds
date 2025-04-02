<?php
require_once 'models/Departamento.php';

class DepartamentoController {
    public function index() {
        $modelo = new Departamento();
        $departamentos = $modelo->getAll();
        include 'views/departamentos/index.php';
    }

    public function create() {
        include 'views/departamentos/create.php';
    }

    public function store() {
        $modelo = new Departamento();
        $modelo->create( $_POST[ 'nombre' ] );
        header( 'Location: index.php?controller=departamento&action=index' );
    }

    public function edit() {
        $modelo = new Departamento();
        $departamento = $modelo->getById( $_GET[ 'id' ] );
        include 'views/departamentos/edit.php';
    }

    public function update() {
        $modelo = new Departamento();
        $modelo->update( $_POST[ 'id' ], $_POST[ 'nombre' ] );
        header( 'Location: index.php?controller=departamento&action=index' );
    }

    public function delete() {
        $modelo = new Departamento();
        $modelo->delete( $_GET[ 'id' ] );
        header( 'Location: index.php?controller=departamento&action=index' );

    }
}