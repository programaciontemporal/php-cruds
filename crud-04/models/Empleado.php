<?php
require_once 'config/database.php';

class Empleado {
    private $conn;

    public function __construct() {
        $this->conn = ( new Database() )->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query(
            'SELECT e.*, d.nombre AS departamento FROM empleados e LEFT JOIN departamentos d ON e.departamento_id = d.id'
        );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function getById( $id ) {
        $stmt = $this->conn->prepare( 'SELECT * FROM empleados WHERE id = ?' );
        $stmt->execute( [ $id ] );
        return $stmt->fetch( PDO::FETCH_ASSOC );
    }

    public function create( $nombre, $email, $departamento_id ) {
        $stmt = $this->conn->prepare( 'INSERT INTO empleados (nombre, email, departamento_id) VALUES (?, ?, ?)' );
        return $stmt->execute( [ $nombre, $email, $departamento_id ] );
    }

    public function update( $id, $nombre, $email, $departamento_id ) {
        $stmt = $this->conn->prepare( 'UPDATE empleados SET nombre = ?, email = ?, departamento_id = ? WHERE id = ?' );
        return $stmt->execute( [ $nombre, $email, $departamento_id, $id ] );
    }

    public function delete( $id ) {
        $stmt = $this->conn->prepare( 'DELETE FROM empleados WHERE id = ?' );
        return $stmt->execute( [ $id ] );
    }
}
