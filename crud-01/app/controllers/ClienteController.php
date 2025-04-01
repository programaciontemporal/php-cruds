<?php
require_once __DIR__ . '/../models/Clientes.php';
require_once __DIR__ . '/../../config/database.php';

class ClienteController {
    private $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function index() {
        $cliente = new Cliente($this->db);
        $clientes = $cliente->leerTodos()->fetchAll(PDO::FETCH_ASSOC);
        
        $modulo = 'cliente';
        include __DIR__ . '/../views/clientes/index.php';
    }

    public function create() {
        $error = null;

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
            $cliente = new Cliente( $this->db );
            $cliente->nombre = htmlspecialchars( strip_tags( $_POST[ 'nombre' ] ) );
            $cliente->email = htmlspecialchars( strip_tags( $_POST[ 'email' ] ) );
            $cliente->telefono = htmlspecialchars( strip_tags( $_POST[ 'telefono' ] ) );

            if ( $cliente->crear() ) {
                header( 'Location: index.php' );
                exit;
            } else {
                $error = 'No se pudo crear el cliente.';
            }
        }
        include __DIR__ . '/../views/clientes/create.php';
    }

    public function update() {
        $error = null;
        $cliente = null;

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
            $clienteObj = new Cliente( $this->db );
            $clienteObj->id = htmlspecialchars( strip_tags( $_POST[ 'id' ] ) );
            $clienteObj->nombre = htmlspecialchars( strip_tags( $_POST[ 'nombre' ] ) );
            $clienteObj->email = htmlspecialchars( strip_tags( $_POST[ 'email' ] ) );
            $clienteObj->telefono = htmlspecialchars( strip_tags( $_POST[ 'telefono' ] ) );

            if ( $clienteObj->actualizar() ) {
                header( 'Location: index.php' );
                exit;
            } else {
                $error = 'No se pudo actualizar el cliente.';
            }
        } else {
            if ( isset( $_GET[ 'id' ] ) ) {
                $clienteObj = new Cliente( $this->db );
                $clienteObj->id = htmlspecialchars( strip_tags( $_GET[ 'id' ] ) );

                $stmt = $this->db->prepare( 'SELECT * FROM clientes WHERE id = :id' );
                $stmt->bindParam( ':id', $clienteObj->id, PDO::PARAM_INT );
                $stmt->execute();

                if ( $stmt->rowCount() > 0 ) {
                    $cliente = $stmt->fetch( PDO::FETCH_ASSOC );
                } else {
                    die( 'Cliente no encontrado.' );
                }
            }
        }
        include __DIR__ . '/../views/clientes/update.php';
    }

    public function delete() {
        if ( isset( $_GET[ 'id' ] ) ) {
            $cliente = new Cliente( $this->db );
            $cliente->id = htmlspecialchars( strip_tags( $_GET[ 'id' ] ) );

            if ( $cliente->eliminar() ) {
                header( 'Location: index.php' );
                exit;
            } else {
                die( 'No se pudo eliminar el cliente.' );
            }
        }
    }
}
?>