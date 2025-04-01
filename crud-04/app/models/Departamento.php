<?php
require_once __DIR__ . '/../config/database.php';

class Departamento {
    private $conn;

    /**
    * Constructor - Establece la conexión a la base de datos
    */

    public function __construct() {
        try {
            // Versión compatible con ambas implementaciones de Database
            if ( method_exists( 'Database', 'getInstance' ) ) {
                $this->conn = Database::getInstance()->getConnection();
            } else {
                $this->conn = ( new Database() )->connect();
            }
        } catch ( RuntimeException $e ) {
            error_log( 'Error al conectar con la base de datos: ' . $e->getMessage() );
            throw new RuntimeException( 'No se pudo establecer conexión con la base de datos' );
        }
    }

    /**
    * Obtiene todos los departamentos
    * @return array Lista de departamentos
    */

    public function getAll(): array {
        try {
            $stmt = $this->conn->query( 'SELECT * FROM departamentos ORDER BY nombre' );
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::getAll(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al obtener los departamentos' );
        }
    }

    /**
    * Obtiene un departamento por su ID
    * @param int $id ID del departamento
    * @return array|null Datos del departamento o null si no existe
    */

    public function getById( int $id ): ?array {
        try {
            $stmt = $this->conn->prepare( 'SELECT * FROM departamentos WHERE id = ?' );
            $stmt->execute( [ $id ] );
            return $stmt->fetch( PDO::FETCH_ASSOC ) ?: null;
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::getById(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al obtener el departamento' );
        }
    }

    /**
    * Crea un nuevo departamento
    * @param string $nombre Nombre del departamento
    * @return int ID del nuevo departamento creado
    */

    public function create( string $nombre ): int {
        try {
            $stmt = $this->conn->prepare( 'INSERT INTO departamentos (nombre) VALUES (?)' );
            $stmt->execute( [ $nombre ] );
            return $this->conn->lastInsertId();
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::create(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al crear el departamento' );
        }
    }

    /**
    * Actualiza un departamento existente
    * @param int $id ID del departamento a actualizar
    * @param string $nombre Nuevo nombre del departamento
    * @return bool True si la actualización fue exitosa
    */

    public function update( int $id, string $nombre ): bool {
        try {
            $stmt = $this->conn->prepare( 'UPDATE departamentos SET nombre = ? WHERE id = ?' );
            return $stmt->execute( [ $nombre, $id ] );
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::update(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al actualizar el departamento' );
        }
    }

    /**
    * Elimina un departamento
    * @param int $id ID del departamento a eliminar
    * @return bool True si la eliminación fue exitosa
    */

    public function delete( int $id ): bool {
        try {
            $stmt = $this->conn->prepare( 'DELETE FROM departamentos WHERE id = ?' );
            return $stmt->execute( [ $id ] );
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::delete(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al eliminar el departamento' );
        }
    }

    /**
    * Verifica si un departamento existe
    * @param int $id ID del departamento
    * @return bool True si el departamento existe
    */

    public function exists( int $id ): bool {
        try {
            $stmt = $this->conn->prepare( 'SELECT COUNT(*) FROM departamentos WHERE id = ?' );
            $stmt->execute( [ $id ] );
            return $stmt->fetchColumn() > 0;
        } catch ( PDOException $e ) {
            error_log( 'Error en Departamento::exists(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al verificar el departamento' );
        }
    }
}