<?php
require_once __DIR__ . '/../models/Libro.php';

class LibroController {
    private $libro;

    public function __construct() {
        $this->libro = new Libro(require __DIR__ . '/../../config/database.php');
    }

    public function index() {
        $libros = $this->libro->obtenerTodos();
        require_once __DIR__ . '/../views/libros/index.php';
    }

    public function crear() {
        require_once __DIR__ . '/../views/libros/crear.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = [];

            if (empty($_POST['titulo'])) {
                $errores[] = 'El título es obligatorio';
            }

            if (empty($_POST['autor'])) {
                $errores[] = 'El autor es obligatorio';
            }

            if (empty($_POST['anio_publicacion']) || !is_numeric($_POST['anio_publicacion'])) {
                $errores[] = 'El año de publicación no es válido';
            }

            if (empty($errores)) {
                $this->libro->titulo = $_POST['titulo'];
                $this->libro->autor = $_POST['autor'];
                $this->libro->anio_publicacion = $_POST['anio_publicacion'];

                if ($this->libro->crear()) {
                    header('Location: index.php?action=index&success=1');
                    exit();
                } else {
                    $errores[] = 'Error al guardar el libro';
                }
            }

            require_once __DIR__ . '/../views/libros/crear.php';
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $libro = $this->libro->obtenerPorId($id);

            if ($libro) {
                require_once __DIR__ . '/../views/libros/editar.php';
            } else {
                header('Location: index.php?action=index&error=1');
                exit();
            }
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = [];

            if (empty($_POST['titulo'])) {
                $errores[] = 'El título es obligatorio';
            }

            if (empty($_POST['autor'])) {
                $errores[] = 'El autor es obligatorio';
            }

            if (empty($_POST['anio_publicacion']) || !is_numeric($_POST['anio_publicacion'])) {
                $errores[] = 'El año de publicación no es válido';
            }

            if (empty($errores)) {
                $this->libro->id = $_POST['id'];
                $this->libro->titulo = $_POST['titulo'];
                $this->libro->autor = $_POST['autor'];
                $this->libro->anio_publicacion = $_POST['anio_publicacion'];

                if ($this->libro->actualizar()) {
                    header('Location: index.php?action=index&success=2');
                    exit();
                } else {
                    $errores[] = 'Error al actualizar el libro';
                }
            }

            $libro = (object) $_POST;
            require_once __DIR__ . '/../views/libros/editar.php';
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->libro->id = $_GET['id'];

            if ($this->libro->eliminar()) {
                header('Location: index.php?action=index&success=3');
                exit();
            } else {
                header('Location: index.php?action=index&error=2');
                exit();
            }
        }
    }

    public function buscar() {
        if (isset($_GET['q'])) {
            $termino = $_GET['q'];
            $libros = $this->libro->buscar($termino);
            require_once __DIR__ . '/../views/libros/index.php';
        }
    }
}
?>