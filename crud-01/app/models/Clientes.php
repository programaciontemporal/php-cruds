<?php

class Cliente {
    private $conn;
    private $table = 'clientes';

    public $id;
    public $nombre;
    public $email;
    public $telefono;

    public function __construct( $db ) {
        $this->conn = $db;
    }

    // Leer todos los clientes

    public function leerTodos() {
        $sql = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo cliente

    public function crear() {
        $sql = 'INSERT INTO ' . $this->table . ' (nombre, email, telefono)
                VALUES (:nombre, :email, :telefono)';

        $stmt = $this->conn->prepare( $sql );

        // Limpiar y vincular parámetros
        $this->nombre = htmlspecialchars( strip_tags( $this->nombre ) );
        $this->email = htmlspecialchars( strip_tags( $this->email ) );
        $this->telefono = htmlspecialchars( strip_tags( $this->telefono ) );

        $stmt->bindParam( ':nombre', $this->nombre );
        $stmt->bindParam( ':email', $this->email );
        $stmt->bindParam( ':telefono', $this->telefono );

        return $stmt->execute();
    }

    // Actualizar un cliente existente

    public function actualizar() {
        $sql = 'UPDATE ' . $this->table . ' SET 
                nombre = :nombre, 
                email = :email, 
                telefono = :telefono
                WHERE id = :id';

        $stmt = $this->conn->prepare( $sql );

        // Limpiar y vincular parámetros
        $this->nombre = htmlspecialchars( strip_tags( $this->nombre ) );
        $this->email = htmlspecialchars( strip_tags( $this->email ) );
        $this->telefono = htmlspecialchars( strip_tags( $this->telefono ) );
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        $stmt->bindParam( ':nombre', $this->nombre );
        $stmt->bindParam( ':email', $this->email );
        $stmt->bindParam( ':telefono', $this->telefono );
        $stmt->bindParam( ':id', $this->id );

        return $stmt->execute();
    }

    // Eliminar un cliente

    public function eliminar() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare( $sql );

        $this->id = htmlspecialchars( strip_tags( $this->id ) );
        $stmt->bindParam( ':id', $this->id );

        return $stmt->execute();
    }
}
?>