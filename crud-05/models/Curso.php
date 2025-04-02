<?php

require_once __DIR__ . '/../config/database.php';

class Curso {
    private $db;

    public function __construct() {
        $this->db = Database::getConnectionStatic();
    }

    public function getAll() {
        $stmt = $this->db->query( 'SELECT * FROM cursos ORDER BY nombre' );
        return $stmt->fetchAll();
    }

    public function getById( $id ) {
        $stmt = $this->db->prepare( 'SELECT * FROM cursos WHERE id = ?' );
        $stmt->execute( [ $id ] );
        return $stmt->fetch();
    }

    public function create( $data ) {
        $stmt = $this->db->prepare(
            'INSERT INTO cursos (nombre, descripcion, creditos) VALUES (?, ?, ?)'
        );
        $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] ),
            ( int )$data[ 'creditos' ]
        ] );
        return $this->db->lastInsertId();
    }

    public function update( $id, $data ) {
        $stmt = $this->db->prepare(
            'UPDATE cursos SET nombre = ?, descripcion = ?, creditos = ? WHERE id = ?'
        );
        return $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] ),
            ( int )$data[ 'creditos' ],
            $id
        ] );
    }

    public function delete( $id ) {
        $stmt = $this->db->prepare( 'DELETE FROM cursos WHERE id = ?' );
        return $stmt->execute( [ $id ] );
    }

    public function getEstudiantes( $cursoId ) {
        $stmt = $this->db->prepare(
            "SELECT e.* FROM estudiantes e
            JOIN estudiante_curso ec ON e.id = ec.estudiante_id
            WHERE ec.curso_id = ?"
        );
        $stmt->execute( [ $cursoId ] );
        return $stmt->fetchAll();
    }
}