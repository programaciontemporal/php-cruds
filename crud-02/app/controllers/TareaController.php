<?php
require_once __DIR__ . '/../models/Tarea.php';

class TareaController {
    private $tarea;

    public function __construct() {
        $this->tarea = new Tarea();
    }

    public function index() {
        $tareas = $this->tarea->obtenerTodas();
        require_once __DIR__ . '/../views/tareas/index.php';
    }

    public function crear() {
        require_once __DIR__ . '/../views/tareas/crear.php';
    }

    public function guardar() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $errores = [];

            if ( empty( $_POST[ 'descripcion' ] ) ) {
                $errores[] = 'La descripción es obligatoria';
            }

            if ( empty( $_POST[ 'fecha_limite' ] ) || !strtotime( $_POST[ 'fecha_limite' ] ) ) {
                $errores[] = 'La fecha límite no es válida';
            }

            if ( empty( $errores ) ) {
                $this->tarea->descripcion = $_POST[ 'descripcion' ];
                $this->tarea->fecha_limite = $_POST[ 'fecha_limite' ];
                $this->tarea->estado = $_POST[ 'estado' ];

                if ( $this->tarea->crear() ) {
                    header( 'Location: index.php?action=index&success=1' );
                    exit();
                } else {
                    $errores[] = 'Error al guardar la tarea';
                }
            }

            require_once __DIR__ . '/../views/tareas/crear.php';
        }
    }

    public function editar() {
        if ( isset( $_GET[ 'id' ] ) ) {
            $id = $_GET[ 'id' ];
            $tarea = $this->tarea->obtenerPorId( $id );

            if ( $tarea ) {
                require_once __DIR__ . '/../views/tareas/editar.php';
            } else {
                header( 'Location: index.php?action=index&error=1' );
                exit();
            }
        }
    }

    public function actualizar() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $errores = [];

            if ( empty( $_POST[ 'descripcion' ] ) ) {
                $errores[] = 'La descripción es obligatoria';
            }

            if ( empty( $_POST[ 'fecha_limite' ] ) || !strtotime( $_POST[ 'fecha_limite' ] ) ) {
                $errores[] = 'La fecha límite no es válida';
            }

            if ( empty( $errores ) ) {
                $this->tarea->id = $_POST[ 'id' ];
                $this->tarea->descripcion = $_POST[ 'descripcion' ];
                $this->tarea->fecha_limite = $_POST[ 'fecha_limite' ];
                $this->tarea->estado = $_POST[ 'estado' ];

                if ( $this->tarea->actualizar() ) {
                    header( 'Location: index.php?action=index&success=2' );
                    exit();
                } else {
                    $errores[] = 'Error al actualizar la tarea';
                }
            }

            $tarea = ( object ) $_POST;
            require_once __DIR__ . '/../views/tareas/editar.php';
        }
    }

    public function eliminar() {
        if ( isset( $_GET[ 'id' ] ) ) {
            $this->tarea->id = $_GET[ 'id' ];

            if ( $this->tarea->eliminar() ) {
                header( 'Location: index.php?action=index&success=3' );
                exit();
            } else {
                header( 'Location: index.php?action=index&error=2' );
                exit();
            }
        }
    }
}
?>