<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        // Si ya está autenticado, redirigir a la página principal
        if ( $this->usuarioModel->estaAutenticado() ) {
            $this->redirectAfterLogin();
            exit;
        }

        $error = null;
        $username_value = '';

        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
            $username = trim( $_POST[ 'username' ] ?? '' );
            $password = trim( $_POST[ 'password' ] ?? '' );
            $username_value = htmlspecialchars( $username );

            if ( empty( $username ) || empty( $password ) ) {
                $error = 'Usuario y contraseña son requeridos';
            } else {
                $usuario = $this->usuarioModel->obtenerPorUsername( $username );

                if ( $usuario && $this->usuarioModel->verificarPassword( $password, $usuario[ 'password_hash' ] ) ) {
                    if ( $this->usuarioModel->iniciarSesion( $usuario ) ) {
                        $this->redirectAfterLogin();
                        exit;
                    } else {
                        $error = 'Error al iniciar sesión';
                    }
                } else {
                    $error = 'Usuario o contraseña incorrectos';
                }
            }
        }

        require_once __DIR__ . '/../views/login.php';
    }

    private function redirectAfterLogin() {
        // Redirigir a la URL solicitada originalmente o a la página por defecto
        $redirect = $_SESSION[ 'redirect_url' ] ?? 'index.php?controller=categoria&action=index';
        header( "Location: $redirect" );
        exit;
    }

    public function logout() {
        $this->usuarioModel->cerrarSesion();
        header( 'Location: index.php' );
        exit;
    }
}