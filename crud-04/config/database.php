<?php

class Database {
    // 1. Usar constantes para configuración
    private const HOST = 'localhost';
    private const DB_NAME = 'empresa';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const CHARSET = 'utf8mb4';
    // Mejor que utf8 para soporte completo

    // 2. Añadir opciones estándar de PDO
    private const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false, // Usar prepares nativos
        PDO::ATTR_STRINGIFY_FETCHES => false
    ];

    private $conn;

    // 3. Singleton pattern para evitar múltiples conexiones
    private static $instance = null;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect() {
        try {
            $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET;
            $this->conn = new PDO( $dsn, self::USERNAME, self::PASSWORD, self::OPTIONS );
        } catch ( PDOException $e ) {
            // 4. Mejor manejo de errores
            error_log( 'Error de conexión: ' . $e->getMessage() );
            throw new RuntimeException( 'Error al conectar con la base de datos' );
        }
    }

    // 5. Verificar conexión activa
    public function getConnection() {
        if ( $this->conn === null ) {
            $this->connect();
        }
        return $this->conn;
    }

    // 6. Prevenir clonación y serialización

    private function __clone() {
    }

    public function __wakeup() {
        throw new RuntimeException( 'No se puede deserializar una conexión a BD' );
    }
}