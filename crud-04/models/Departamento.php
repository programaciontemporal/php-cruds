<?php
require_once 'config/database.php';

class Departamento {
    private $conn;

    public function __construct() {
        $this->conn = ( new Database() )->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query( 'SELECT * FROM departamentos' );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function getById( $id ) {
        $stmt = $this->conn->prepare( 'SELECT * FROM departamentos WHERE id = ?' );
        $stmt->execute( [ $id ] );
        return $stmt->fetch( PDO::FETCH_ASSOC );
    }

    public function create( $nombre ) {
        $stmt = $this->conn->prepare( 'INSERT INTO departamentos (nombre) VALUES (?)' );
        return $stmt->execute( [ $nombre ] );
    }

    public function update( $id, $nombre ) {
        $stmt = $this->conn->prepare( 'UPDATE departamentos SET nombre = ? WHERE id = ?' );
        return $stmt->execute( [ $nombre, $id ] );
    }

    public function delete( $id ) {
        $stmt = $this->conn->prepare( 'DELETE FROM departamentos WHERE id = ?' );
        return $stmt->execute( [ $id ] );
    }
}
