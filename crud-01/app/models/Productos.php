<?php

class Producto {
    private $conn;
    private $table = 'productos';

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct( $db ) {
        $this->conn = $db;
    }

    public function leerTodos() {
        $sql = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $sql = 'INSERT INTO ' . $this->table . ' (nombre, descripcion, precio)
                VALUES (:nombre, :descripcion, :precio)';

        $stmt = $this->conn->prepare( $sql );

        $this->nombre = htmlspecialchars( strip_tags( $this->nombre ) );
        $this->descripcion = htmlspecialchars( strip_tags( $this->descripcion ) );
        $this->precio = htmlspecialchars( strip_tags( $this->precio ) );

        $stmt->bindParam( ':nombre', $this->nombre );
        $stmt->bindParam( ':descripcion', $this->descripcion );
        $stmt->bindParam( ':precio', $this->precio );

        return $stmt->execute();
    }

    public function actualizar() {
        $sql = 'UPDATE ' . $this->table . ' SET 
                nombre = :nombre, 
                descripcion = :descripcion, 
                precio = :precio
                WHERE id = :id';

        $stmt = $this->conn->prepare( $sql );

        $this->nombre = htmlspecialchars( strip_tags( $this->nombre ) );
        $this->descripcion = htmlspecialchars( strip_tags( $this->descripcion ) );
        $this->precio = htmlspecialchars( strip_tags( $this->precio ) );
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        $stmt->bindParam( ':nombre', $this->nombre );
        $stmt->bindParam( ':descripcion', $this->descripcion );
        $stmt->bindParam( ':precio', $this->precio );
        $stmt->bindParam( ':id', $this->id );

        return $stmt->execute();
    }

    public function eliminar() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare( $sql );

        $this->id = htmlspecialchars( strip_tags( $this->id ) );
        $stmt->bindParam( ':id', $this->id );

        return $stmt->execute();
    }
}
?>