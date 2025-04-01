<?php
require_once __DIR__ . '/../config/database.php';

class Empleado {
    private $conn;

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
    * Obtiene todos los empleados con información de departamento
    * @return array Lista de empleados
    */

    public function getAll(): array {
        try {
            $query = "SELECT e.*, d.nombre AS departamento 
                      FROM empleados e 
                      LEFT JOIN departamentos d ON e.departamento_id = d.id
                      ORDER BY e.nombre";

            $stmt = $this->conn->query( $query );
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::getAll(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al obtener los empleados' );
        }
    }

    /**
    * Obtiene un empleado por su ID
    * @param int $id ID del empleado
    * @return array|null Datos del empleado o null si no existe
    */

    public function getById( int $id ): ?array {
        try {
            $stmt = $this->conn->prepare(
                "SELECT e.*, d.nombre AS departamento 
                 FROM empleados e 
                 LEFT JOIN departamentos d ON e.departamento_id = d.id
                 WHERE e.id = ?"
            );
            $stmt->execute( [ $id ] );
            return $stmt->fetch( PDO::FETCH_ASSOC ) ?: null;
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::getById(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al obtener el empleado' );
        }
    }

    /**
    * Crea un nuevo empleado
    * @param string $nombre Nombre del empleado
    * @param string $email Email del empleado
    * @param int $departamento_id ID del departamento
    * @return int ID del nuevo empleado creado
    */

    public function create( string $nombre, string $email, int $departamento_id ): int {
        try {
            // Validar email
            if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                throw new InvalidArgumentException( 'El email proporcionado no es válido' );
            }

            $stmt = $this->conn->prepare(
                "INSERT INTO empleados (nombre, email, departamento_id) 
                 VALUES (?, ?, ?)"
            );
            $stmt->execute( [ $nombre, $email, $departamento_id ] );
            return $this->conn->lastInsertId();
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::create(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al crear el empleado' );
        }
    }

    /**
    * Actualiza un empleado existente
    * @param int $id ID del empleado
    * @param string $nombre Nuevo nombre
    * @param string $email Nuevo email
    * @param int $departamento_id Nuevo departamento
    * @return bool True si la actualización fue exitosa
    */

    public function update( int $id, string $nombre, string $email, int $departamento_id ): bool {
        try {
            // Validar email
            if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                throw new InvalidArgumentException( 'El email proporcionado no es válido' );
            }

            $stmt = $this->conn->prepare(
                "UPDATE empleados 
                 SET nombre = ?, email = ?, departamento_id = ? 
                 WHERE id = ?"
            );
            return $stmt->execute( [ $nombre, $email, $departamento_id, $id ] );
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::update(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al actualizar el empleado' );
        }
    }

    /**
    * Elimina un empleado
    * @param int $id ID del empleado a eliminar
    * @return bool True si la eliminación fue exitosa
    */

    public function delete( int $id ): bool {
        try {
            $stmt = $this->conn->prepare( 'DELETE FROM empleados WHERE id = ?' );
            return $stmt->execute( [ $id ] );
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::delete(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al eliminar el empleado' );
        }
    }

    /**
    * Busca empleados por nombre o email
    * @param string $search Término de búsqueda
    * @return array Empleados que coinciden con la búsqueda
    */

    public function search( string $search ): array {
        try {
            $stmt = $this->conn->prepare(
                "SELECT e.*, d.nombre AS departamento 
                 FROM empleados e
                 LEFT JOIN departamentos d ON e.departamento_id = d.id
                 WHERE e.nombre LIKE ? OR e.email LIKE ?
                 ORDER BY e.nombre"
            );
            $searchTerm = "%$search%";
            $stmt->execute( [ $searchTerm, $searchTerm ] );
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            error_log( 'Error en Empleado::search(): ' . $e->getMessage() );
            throw new RuntimeException( 'Error al buscar empleados' );
        }
    }
}