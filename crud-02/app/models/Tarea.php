<?php
require_once __DIR__ . '/../../config/database.php';

class Tarea {
    private $conn;
    private $table = 'tareas';

    public $id;
    public $descripcion;
    public $fecha_limite;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerTodas() {
        $query = "SELECT * FROM {$this->table} ORDER BY fecha_limite ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    public function obtenerPorId( $id ) {
        $query = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam( 1, $id );
        $stmt->execute();
        return $stmt->fetch( PDO::FETCH_ASSOC );
    }

    public function crear() {
        $query = "INSERT INTO {$this->table} (descripcion, fecha_limite, estado) 
                  VALUES (:descripcion, :fecha_limite, :estado)";

        $stmt = $this->conn->prepare( $query );

        $this->descripcion = htmlspecialchars( strip_tags( $this->descripcion ) );
        $this->fecha_limite = htmlspecialchars( strip_tags( $this->fecha_limite ) );
        $this->estado = htmlspecialchars( strip_tags( $this->estado ) );

        $stmt->bindParam( ':descripcion', $this->descripcion );
        $stmt->bindParam( ':fecha_limite', $this->fecha_limite );
        $stmt->bindParam( ':estado', $this->estado );

        return $stmt->execute();
    }

    public function actualizar() {
        $query = "UPDATE {$this->table} 
                  SET descripcion = :descripcion, 
                      fecha_limite = :fecha_limite, 
                      estado = :estado 
                  WHERE id = :id";

        $stmt = $this->conn->prepare( $query );

        $this->descripcion = htmlspecialchars( strip_tags( $this->descripcion ) );
        $this->fecha_limite = htmlspecialchars( strip_tags( $this->fecha_limite ) );
        $this->estado = htmlspecialchars( strip_tags( $this->estado ) );
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        $stmt->bindParam( ':descripcion', $this->descripcion );
        $stmt->bindParam( ':fecha_limite', $this->fecha_limite );
        $stmt->bindParam( ':estado', $this->estado );
        $stmt->bindParam( ':id', $this->id );

        return $stmt->execute();
    }

    public function eliminar() {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam( 1, $this->id );
        return $stmt->execute();
    }
}
?>