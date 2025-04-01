<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Gestión de Libros</title>
    <!-- Bootswatch Slate Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    .book-card {
        transition: transform 0.2s;
    }

    .book-card:hover {
        transform: translateY(-3px);
    }

    .search-box {
        max-width: 400px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=index">
                <i class="bi bi-book me-2"></i>Biblioteca
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=index">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=crear">
                            <i class="bi bi-plus-circle me-1"></i>Nuevo Libro
                        </a>
                    </li>
                </ul>
                <form class="d-flex search-box" action="index.php" method="get">
                    <input type="hidden" name="action" value="buscar">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar libros..."
                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php if ($_GET['success'] == 1): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Libro creado correctamente!
            <?php elseif ($_GET['success'] == 2): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Libro actualizado correctamente!
            <?php elseif ($_GET['success'] == 3): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Libro eliminado correctamente!
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php if ($_GET['error'] == 1): ?>
            <i class="bi bi-exclamation-triangle-fill me-2"></i>No se encontró el libro solicitado
            <?php elseif ($_GET['error'] == 2): ?>
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Error al eliminar el libro
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>