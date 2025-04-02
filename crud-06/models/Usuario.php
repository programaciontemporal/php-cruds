<?php

require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getConnectionStatic();
    }

    public function obtenerPorUsername( $username ) {
        $stmt = $this->db->prepare( 'SELECT * FROM usuarios WHERE username = ? LIMIT 1' );
        $stmt->execute( [ $username ] );
        return $stmt->fetch();
    }

    public function verificarPassword( $password, $hash ) {
        return password_verify( $password, $hash );
    }

    public function iniciarSesion( $usuario ) {
        $_SESSION[ 'usuario' ] = [
            'id' => $usuario[ 'id' ],
            'username' => $usuario[ 'username' ],
            'nombre' => $usuario[ 'nombre' ],
            'email' => $usuario[ 'email' ],
            'rol' => $usuario[ 'rol' ]
        ];
        return true;
    }

    public function cerrarSesion() {
        unset( $_SESSION[ 'usuario' ] );
        session_destroy();
        return true;
    }

    public function estaAutenticado() {
        return isset( $_SESSION[ 'usuario' ] );
    }
}