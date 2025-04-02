<?php

require_once __DIR__ . '/../config/database.php';

class Estudiante {
    private $db;

    public function __construct() {
        $this->db = Database::getConnectionStatic();
    }

    public function getAll() {
        $stmt = $this->db->query( 'SELECT * FROM estudiantes ORDER BY apellido, nombre' );
        return $stmt->fetchAll();
    }

    public function getById( $id ) {
        $stmt = $this->db->prepare( 'SELECT * FROM estudiantes WHERE id = ?' );
        $stmt->execute( [ $id ] );
        return $stmt->fetch();
    }

    public function create( $data ) {
        $stmt = $this->db->prepare(
            'INSERT INTO estudiantes (nombre, apellido, email) VALUES (?, ?, ?)'
        );
        $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'apellido' ] ),
            filter_var( $data[ 'email' ], FILTER_SANITIZE_EMAIL )
        ] );
        return $this->db->lastInsertId();
    }

    public function update( $id, $data ) {
        $stmt = $this->db->prepare(
            'UPDATE estudiantes SET nombre = ?, apellido = ?, email = ? WHERE id = ?'
        );
        return $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'apellido' ] ),
            filter_var( $data[ 'email' ], FILTER_SANITIZE_EMAIL ),
            $id
        ] );
    }

    public function delete( $id ) {
        $stmt = $this->db->prepare( 'DELETE FROM estudiantes WHERE id = ?' );
        return $stmt->execute( [ $id ] );
    }

    public function getCursos( $estudianteId ) {
        $stmt = $this->db->prepare(
            "SELECT c.* FROM cursos c
            JOIN estudiante_curso ec ON c.id = ec.curso_id
            WHERE ec.estudiante_id = ?"
        );
        $stmt->execute( [ $estudianteId ] );
        return $stmt->fetchAll();
    }

    public function addCurso( $estudianteId, $cursoId ) {
        $stmt = $this->db->prepare(
            'INSERT INTO estudiante_curso (estudiante_id, curso_id) VALUES (?, ?)'
        );
        return $stmt->execute( [ $estudianteId, $cursoId ] );
    }

    public function removeCurso( $estudianteId, $cursoId ) {
        $stmt = $this->db->prepare(
            'DELETE FROM estudiante_curso WHERE estudiante_id = ? AND curso_id = ?'
        );
        return $stmt->execute( [ $estudianteId, $cursoId ] );
    }

    public function getAvailableCursos( $estudianteId ) {
        $stmt = $this->db->prepare(
            "SELECT * FROM cursos WHERE id NOT IN (
                SELECT curso_id FROM estudiante_curso WHERE estudiante_id = ?
            )"
        );
        $stmt->execute( [ $estudianteId ] );
        return $stmt->fetchAll();
    }
}