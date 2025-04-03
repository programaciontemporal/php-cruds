<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <!-- Bootstrap Theme y estilos propios -->
    <link href="/cruds/crud-06/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cruds/crud-06/assets/css/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/cruds/crud-06/assets/css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inventario</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
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
                    <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-white">
                            <?= htmlspecialchars($_SESSION['usuario']['nombre']) ."&nbsp" ?>
                        </div>
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                            style="width: 36px; height: 36px;">
                            <span
                                class="text-white"><?= strtoupper(substr($_SESSION['usuario']['nombre'], 0, 1)) ?></span>
                        </div>
                        <a href="index.php?controller=Auth&action=logout" class="btn btn-sm btn-outline-light ms-3">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="d-flex">
                        <a href="index.php?controller=Auth&action=login" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right"></i> Ingresar
                        </a>
                    </div>
                    <?php endif; ?>
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