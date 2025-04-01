<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .navbar-brand {
        font-weight: 600;
    }

    .task-card {
        transition: transform 0.2s;
    }

    .task-card:hover {
        transform: translateY(-3px);
    }

    .completed {
        text-decoration: line-through;
        color: #6c757d;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=index">
                <i class="bi bi-check2-square me-2"></i>Gestor de Tareas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=index">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=crear">
                            <i class="bi bi-plus-circle me-1"></i>Nueva Tarea
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php if ($_GET['success'] == 1): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Tarea creada correctamente!
            <?php elseif ($_GET['success'] == 2): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Tarea actualizada correctamente!
            <?php elseif ($_GET['success'] == 3): ?>
            <i class="bi bi-check-circle-fill me-2"></i>¡Tarea eliminada correctamente!
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php if ($_GET['error'] == 1): ?>
            <i class="bi bi-exclamation-triangle-fill me-2"></i>No se encontró la tarea solicitada
            <?php elseif ($_GET['error'] == 2): ?>
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Error al eliminar la tarea
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>