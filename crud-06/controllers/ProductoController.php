<?php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController {
    private $productoModel;
    private $categoriaModel;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->categoriaModel = new Categoria();
    }

    public function index() {
        $productos = $this->productoModel->getAllWithCategory();
        require __DIR__ . '/../views/productos/index.php';
    }

    public function create() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ],
                'precio' => $_POST[ 'precio' ],
                'stock' => $_POST[ 'stock' ],
                'categoria_id' => $_POST[ 'categoria_id' ]
            ];

            if ( $this->productoModel->create( $data ) ) {
                $_SESSION[ 'message' ] = 'Producto creado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Producto&action=index' );
                exit;
            }
        }

        $categorias = $this->categoriaModel->getAll();
        require __DIR__ . '/../views/productos/create.php';
    }

    public function edit( $id ) {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $data = [
                'nombre' => $_POST[ 'nombre' ],
                'descripcion' => $_POST[ 'descripcion' ],
                'precio' => $_POST[ 'precio' ],
                'stock' => $_POST[ 'stock' ],
                'categoria_id' => $_POST[ 'categoria_id' ]
            ];

            if ( $this->productoModel->update( $id, $data ) ) {
                $_SESSION[ 'message' ] = 'Producto actualizado correctamente';
                $_SESSION[ 'message_type' ] = 'success';
                header( 'Location: index.php?controller=Producto&action=index' );
                exit;
            }
        }

        $producto = $this->productoModel->getById( $id );
        if ( !$producto ) {
            header( 'Location: index.php?controller=Producto&action=index' );
            exit;
        }

        $categorias = $this->categoriaModel->getAll();
        require __DIR__ . '/../views/productos/edit.php';
    }

    public function delete( $id ) {
        if ( $this->productoModel->delete( $id ) ) {
            $_SESSION[ 'message' ] = 'Producto eliminado correctamente';
            $_SESSION[ 'message_type' ] = 'success';
        } else {
            $_SESSION[ 'message' ] = 'Error al eliminar el producto';
            $_SESSION[ 'message_type' ] = 'danger';
        }
        header( 'Location: index.php?controller=Producto&action=index' );
        exit;
    }

    public function show( $id ) {
        $producto = $this->productoModel->getById( $id );
        if ( !$producto ) {
            header( 'Location: index.php?controller=Producto&action=index' );
            exit;
        }

        require __DIR__ . '/../views/productos/show.php';
    }
}