<?php

require_once __DIR__ . '/../models/Estudiante.php';
require_once __DIR__ . '/../models/Curso.php';

class EstudianteController {
    private $estudianteModel;
    private $cursoModel;

    public function __construct() {
        $this->estudianteModel = new Estudiante();
        $this->cursoModel = new Curso();
    }

    public function index() {
        $estudiantes = $this->estudianteModel->getAll();
        require __DIR__ . '/../views/estudiantes/index.php';
    }

    public function create() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'apellido' => $_POST[ 'apellido' ],
                'email' => $_POST[ 'email' ]
            ];

            if ( $this->estudianteModel->create( $data ) ) {
                $_SESSION[ 'message' ] = 'Estudiante creado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Estudiante&action=index' );
                exit;
            }
        }
        require __DIR__ . '/../views/estudiantes/create.php';
    }

    public function edit( $id ) {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'apellido' => $_POST[ 'apellido' ],
                'email' => $_POST[ 'email' ]
            ];

            if ( $this->estudianteModel->update( $id, $data ) ) {
                $_SESSION[ 'message' ] = 'Estudiante actualizado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Estudiante&action=index' );
                exit;
            }
        }

        $estudiante = $this->estudianteModel->getById( $id );
        if ( !$estudiante ) {
            header( 'Location: index.php?controller=Estudiante&action=index' );
            exit;
        }

        require __DIR__ . '/../views/estudiantes/edit.php';
    }

    public function delete( $id ) {
        if ( $this->estudianteModel->delete( $id ) ) {
            $_SESSION[ 'message' ] = 'Estudiante eliminado correctamente';
            $_SESSION[ 'message_type' ] = 'success';
        } else {
            $_SESSION[ 'message' ] = 'Error al eliminar el estudiante';
            $_SESSION[ 'message_type' ] = 'danger';
        }
        header( 'Location: index.php?controller=Estudiante&action=index' );
        exit;
    }

    public function show( $id ) {
        $estudiante = $this->estudianteModel->getById( $id );
        if ( !$estudiante ) {
            header( 'Location: index.php?controller=Estudiante&action=index' );
            exit;
        }

        $cursos = $this->estudianteModel->getCursos( $id );
        $cursosDisponibles = $this->estudianteModel->getAvailableCursos( $id );

        require __DIR__ . '/../views/estudiantes/show.php';
    }

    public function addCurso( $id ) {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $_POST[ 'curso_id' ] ) ) {
            $cursoId = ( int )$_POST[ 'curso_id' ];
            if ( $this->estudianteModel->addCurso( $id, $cursoId ) ) {
                $_SESSION[ 'message' ] = 'Curso asignado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
            } else {
                $_SESSION[ 'message' ] = 'Error al asignar el curso';
                $_SESSION[ 'message_type' ] = 'danger';
            }
        }
        header( "Location: index.php?controller=Estudiante&action=show&id=$id" );
        exit;
    }

    public function removeCurso( $estudianteId, $cursoId ) {
        if ( $this->estudianteModel->removeCurso( $estudianteId, $cursoId ) ) {
            $_SESSION[ 'message' ] = 'Curso eliminado correctamente';
            $_SESSION[ 'message_type' ] = 'success';
        } else {
            $_SESSION[ 'message' ] = 'Error al eliminar el curso';
            $_SESSION[ 'message_type' ] = 'danger';
        }
        header( "Location: index.php?controller=Estudiante&action=show&id=$estudianteId" );
        exit;
    }
}