<?php

require_once __DIR__ . '/../config/database.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = Database::getConnectionStatic();
    }

    public function getAllWithCategory() {
        $stmt = $this->db->query(
            "SELECT p.*, c.nombre AS categoria_nombre 
             FROM productos p 
             JOIN categorias c ON p.categoria_id = c.id 
             ORDER BY p.nombre"
        );
        return $stmt->fetchAll();
    }

    public function getById( $id ) {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.nombre AS categoria_nombre 
             FROM productos p 
             JOIN categorias c ON p.categoria_id = c.id 
             WHERE p.id = ?"
        );
        $stmt->execute( [ $id ] );
        return $stmt->fetch();
    }

    public function create( $data ) {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id) 
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] ),
            filter_var( $data[ 'precio' ], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
            filter_var( $data[ 'stock' ], FILTER_SANITIZE_NUMBER_INT ),
            $data[ 'categoria_id' ]
        ] );
        return $this->db->lastInsertId();
    }

    public function update( $id, $data ) {
        $stmt = $this->db->prepare(
            "UPDATE productos SET 
                nombre = ?, 
                descripcion = ?, 
                precio = ?, 
                stock = ?, 
                categoria_id = ? 
             WHERE id = ?"
        );
        return $stmt->execute( [
            htmlspecialchars( $data[ 'nombre' ] ),
            htmlspecialchars( $data[ 'descripcion' ] ),
            filter_var( $data[ 'precio' ], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
            filter_var( $data[ 'stock' ], FILTER_SANITIZE_NUMBER_INT ),
            $data[ 'categoria_id' ],
            $id
        ] );
    }

    public function delete( $id ) {
        $stmt = $this->db->prepare( 'DELETE FROM productos WHERE id = ?' );
        return $stmt->execute( [ $id ] );
    }

    public function getByCategoria( $categoriaId ) {
        $stmt = $this->db->prepare( 'SELECT * FROM productos WHERE categoria_id = ?' );
        $stmt->execute( [ $categoriaId ] );
        return $stmt->fetchAll();
    }
}