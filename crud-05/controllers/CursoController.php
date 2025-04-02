<?php

require_once __DIR__ . '/../models/Curso.php';

class CursoController {
    private $cursoModel;

    public function __construct() {
        $this->cursoModel = new Curso();
    }

    public function index() {
        $cursos = $this->cursoModel->getAll();
        require __DIR__ . '/../views/cursos/index.php';
    }

    public function create() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ],
                'creditos' => $_POST[ 'creditos' ]
            ];

            if ( $this->cursoModel->create( $data ) ) {
                $_SESSION[ 'message' ] = 'Curso creado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Curso&action=index' );
                exit;
            }
        }
        require __DIR__ . '/../views/cursos/create.php';
    }

    public function edit( $id ) {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ],
                'creditos' => $_POST[ 'creditos' ]
            ];

            if ( $this->cursoModel->update( $id, $data ) ) {
                $_SESSION[ 'message' ] = 'Curso actualizado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Curso&action=index' );
                exit;
            }
        }

        $curso = $this->cursoModel->getById( $id );
        if ( !$curso ) {
            header( 'Location: index.php?controller=Curso&action=index' );
            exit;
        }

        require __DIR__ . '/../views/cursos/edit.php';
    }

    public function delete( $id ) {
        if ( $this->cursoModel->delete( $id ) ) {
            $_SESSION[ 'message' ] = 'Curso eliminado correctamente';
            $_SESSION[ 'message_type' ] = 'success';
        } else {
            $_SESSION[ 'message' ] = 'Error al eliminar el curso';
            $_SESSION[ 'message_type' ] = 'danger';
        }
        header( 'Location: index.php?controller=Curso&action=index' );
        exit;
    }

    public function show( $id ) {
        $curso = $this->cursoModel->getById( $id );
        if ( !$curso ) {
            header( 'Location: index.php?controller=Curso&action=index' );
            exit;
        }

        $estudiantes = $this->cursoModel->getEstudiantes( $id );
        require __DIR__ . '/../views/cursos/show.php';
    }
}