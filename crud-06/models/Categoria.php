<?php

require_once __DIR__ . '/../config/database.php';

class Categoria {
    private $db;

    public function __construct() {
        $this->db = Database::getConnectionStatic();
    }

    public function getAll() {
        $stmt = $this->db->query( 'SELECT * FROM categorias ORDER BY nombre' );
        return $stmt->fetchAll();
    }

    public function getById( $id ) {
        $stmt = $this->db->prepare( 'SELECT * FROM categorias WHERE id = ?' );
        $stmt->execute( [ $id ] );
        return $stmt->fetch();
    }

    public function create( $data ) {
        $stmt = $this->db->prepare(
            'INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)'
        );
        $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] )
        ] );
        return $this->db->lastInsertId();
    }

    public function update( $id, $data ) {
        $stmt = $this->db->prepare(
            'UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?'
        );
        return $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] ),
            $id
        ] );
    }

    public function delete( $id ) {
        try {
            $stmt = $this->db->prepare( 'DELETE FROM categorias WHERE id = ?' );
            return $stmt->execute( [ $id ] );
        } catch ( PDOException $e ) {
            if ( $e->getCode() == '23000' ) {
                throw new Exception( 'No se puede eliminar la categoría porque tiene productos asociados' );
            }
            throw $e;
        }
    }

    public function countProductos( $categoriaId ) {
        $stmt = $this->db->prepare( 'SELECT COUNT(*) FROM productos WHERE categoria_id = ?' );
        $stmt->execute( [ $categoriaId ] );
        return $stmt->fetchColumn();
    }
}