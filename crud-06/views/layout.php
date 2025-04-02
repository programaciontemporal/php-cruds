<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        padding-top: 20px;
    }

    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .navbar-brand {
        font-weight: bold;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .user-nav {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #4e5d6c;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inventario</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=Categoria&action=index">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=Producto&action=index">Productos</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <div class="user-nav">
                                <div class="user-avatar">
                                    <?= strtoupper(substr($_SESSION['usuario']['nombre'], 0, 1)) ?>
                                </div>
                                <span class="text-light"><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></span>
                                <a href="index.php?controller=Auth&action=logout" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-box-arrow-right"></i> Salir
                                </a>
                            </div>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a href="index.php?controller=Auth&action=login" class="btn btn-outline-light">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <?= $content ?? '' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>