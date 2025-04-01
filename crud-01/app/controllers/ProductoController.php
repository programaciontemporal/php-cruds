<?php
require_once __DIR__ . '/../models/Productos.php';
require_once __DIR__ . '/../../config/database.php';

class ProductoController {
    private $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function index() {
        $producto = new Producto($this->db);
        $stmt = $producto->leerTodos();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Asegúrate de definir $productos
        
        $modulo = 'producto';
        
        // Pasar las variables a la vista
        include __DIR__ . '/../views/productos/index.php';
    }
    
    public function create() {
        $error = null;

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
            $producto = new Producto( $this->db );
            $producto->nombre = htmlspecialchars( strip_tags( $_POST[ 'nombre' ] ) );
            $producto->descripcion = htmlspecialchars( strip_tags( $_POST[ 'descripcion' ] ) );
            $producto->precio = htmlspecialchars( strip_tags( $_POST[ 'precio' ] ) );

            if ( $producto->crear() ) {
                header( 'Location: index.php?modulo=producto&accion=index' );
                exit;
            } else {
                $error = 'No se pudo crear el producto.';
            }
        }
        include __DIR__ . '/../views/productos/create.php';
    }

    public function update() {
        $error = null;
        $producto = null;

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
            $productoObj = new Producto( $this->db );
            $productoObj->id = htmlspecialchars( strip_tags( $_POST[ 'id' ] ) );
            $productoObj->nombre = htmlspecialchars( strip_tags( $_POST[ 'nombre' ] ) );
            $productoObj->descripcion = htmlspecialchars( strip_tags( $_POST[ 'descripcion' ] ) );
            $productoObj->precio = htmlspecialchars( strip_tags( $_POST[ 'precio' ] ) );

            if ( $productoObj->actualizar() ) {
                header( 'Location: index.php?modulo=producto&accion=index' );
                exit;
            } else {
                $error = 'No se pudo actualizar el producto.';
            }
        } else {
            if ( isset( $_GET[ 'id' ] ) ) {
                $productoObj = new Producto( $this->db );
                $productoObj->id = htmlspecialchars( strip_tags( $_GET[ 'id' ] ) );

                $stmt = $this->db->prepare( 'SELECT * FROM productos WHERE id = :id' );
                $stmt->bindParam( ':id', $productoObj->id, PDO::PARAM_INT );
                $stmt->execute();

                if ( $stmt->rowCount() > 0 ) {
                    $producto = $stmt->fetch( PDO::FETCH_ASSOC );
                } else {
                    die( 'Producto no encontrado.' );
                }
            }
        }
        include __DIR__ . '/../views/productos/update.php';
    }

    public function delete() {
        if ( isset( $_GET[ 'id' ] ) ) {
            $producto = new Producto( $this->db );
            $producto->id = htmlspecialchars( strip_tags( $_GET[ 'id' ] ) );

            if ( $producto->eliminar() ) {
                header( 'Location: index.php?modulo=producto&accion=index' );
                exit;
            } else {
                die( 'No se pudo eliminar el producto.' );
            }
        }
    }
}
?>