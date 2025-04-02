<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    private $categoriaModel;

    public function __construct() {
        $this->categoriaModel = new Categoria();
    }

    public function index() {
        $categorias = $this->categoriaModel->getAll();
        require __DIR__ . '/../views/categorias/index.php';
    }

    public function create() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ]
            ];

            if ( $this->categoriaModel->create( $data ) ) {
                $_SESSION[ 'message' ] = 'Categoría creada correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Categoria&action=index' );
                exit;
            }
        }
        require __DIR__ . '/../views/categorias/create.php';
    }

    public function edit( $id ) {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ]
            ];

            if ( $this->categoriaModel->update( $id, $data ) ) {
                $_SESSION[ 'message' ] = 'Categoría actualizada correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Categoria&action=index' );
                exit;
            }
        }

        $categoria = $this->categoriaModel->getById( $id );
        if ( !$categoria ) {
            header( 'Location: index.php?controller=Categoria&action=index' );
            exit;
        }

        require __DIR__ . '/../views/categorias/edit.php';
    }

    public function delete( $id ) {
        try {
            if ( $this->categoriaModel->delete( $id ) ) {
                $_SESSION[ 'message' ] = 'Categoría eliminada correctamente';
                $_SESSION[ 'message_type' ] = 'success';
            }
        } catch ( Exception $e ) {
            $_SESSION[ 'message' ] = $e->getMessage();
            $_SESSION[ 'message_type' ] = 'danger';
        }
        header( 'Location: index.php?controller=Categoria&action=index' );
        exit;
    }

    public function show( $id ) {
        $categoria = $this->categoriaModel->getById( $id );
        if ( !$categoria ) {
            header( 'Location: index.php?controller=Categoria&action=index' );
            exit;
        }

        $productos = $this->categoriaModel->getProductos( $id );
        require __DIR__ . '/../views/categorias/show.php';
    }
}