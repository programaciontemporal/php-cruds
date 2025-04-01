<?php
require_once __DIR__ . '/../../config/database.php';

class Libro {
    private $conn;
    private $table = 'libros';

    public $id;
    public $titulo;
    public $autor;
    public $anio_publicacion;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM {$this->table} ORDER BY titulo ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    public function obtenerPorId( $id ) {
        $query = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute( [ $id ] );
        return $stmt->fetch();
    }

    public function crear() {
        $query = "INSERT INTO {$this->table} (titulo, autor, anio_publicacion) 
                  VALUES (:titulo, :autor, :anio_publicacion)";

        $stmt = $this->conn->prepare( $query );

        $this->titulo = htmlspecialchars( strip_tags( $this->titulo ) );
        $this->autor = htmlspecialchars( strip_tags( $this->autor ) );
        $this->anio_publicacion = htmlspecialchars( strip_tags( $this->anio_publicacion ) );

        return $stmt->execute( [
            ':titulo' => $this->titulo,
            ':autor' => $this->autor,
            ':anio_publicacion' => $this->anio_publicacion
        ] );
    }

    public function actualizar() {
        $query = "UPDATE {$this->table} 
                  SET titulo = :titulo, 
                      autor = :autor, 
                      anio_publicacion = :anio_publicacion 
                  WHERE id = :id";

        $stmt = $this->conn->prepare( $query );

        $this->titulo = htmlspecialchars( strip_tags( $this->titulo ) );
        $this->autor = htmlspecialchars( strip_tags( $this->autor ) );
        $this->anio_publicacion = htmlspecialchars( strip_tags( $this->anio_publicacion ) );
        $this->id = htmlspecialchars( strip_tags( $this->id ) );

        return $stmt->execute( [
            ':titulo' => $this->titulo,
            ':autor' => $this->autor,
            ':anio_publicacion' => $this->anio_publicacion,
            ':id' => $this->id
        ] );
    }

    public function eliminar() {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare( $query );
        return $stmt->execute( [ $this->id ] );
    }

    public function buscar( $termino ) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE titulo LIKE :termino 
                  ORDER BY titulo ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute( [ ':termino' => "%$termino%" ] );
        return $stmt;
    }
}
?>