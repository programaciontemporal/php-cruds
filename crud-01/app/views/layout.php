<?php
// app/views/layout.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema CRUD</title>
    <style>
    /* Estilos para el menú */
    .main-nav {
        background: #f0f0f0;
        padding: 15px;
        margin-bottom: 20px;
    }

    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 20px;
    }

    .nav-item a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .nav-item a:hover {
        background-color: #e0e0e0;
    }

    .nav-item.active a {
        background-color: #0066cc;
        color: white;
    }

    .action-button {
        display: inline-block;
        background: #0066cc;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 10px;
    }

    /* Estilos para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <?php if (!isset($accion) || !in_array($accion, ['delete'])): ?>
    <nav class="main-nav">
        <ul class="nav-list">
            <li class="nav-item <?= ($modulo ?? 'cliente') === 'cliente' ? 'active' : '' ?>">
                <a href="index.php?modulo=cliente">Clientes</a>
            </li>
            <li class="nav-item <?= ($modulo ?? 'cliente') === 'producto' ? 'active' : '' ?>">
                <a href="index.php?modulo=producto">Productos</a>
            </li>
        </ul>

        <?php if (($modulo ?? 'cliente') === 'cliente'): ?>
        <a href="index.php?modulo=cliente&accion=create" class="action-button">
            Agregar Cliente
        </a>
        <?php else: ?>
        <a href="index.php?modulo=producto&accion=create" class="action-button">
            Agregar Producto
        </a>
        <?php endif; ?>
    </nav>
    <?php endif; ?>

    <main class="content">
        <?= $contenido ?>
    </main>
</body>

</html>