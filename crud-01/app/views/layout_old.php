<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Aplicación MVC</title>
    <style>
    nav ul {
        list-style: none;
        padding: 0;
    }

    nav li {
        display: inline;
        margin-right: 10px;
    }
    </style>
</head>

<body>
    <!-- Menú común -->
    <nav>
        <ul>
            <li><a href="index.php?accion=index">Inicio</a></li>
            <li><a href="index.php?accion=create">Agregar Cliente</a></li>
            <li><a href="index.php?modulo=producto">Cambiar a productos</a></li>
        </ul>
    </nav>
    <hr>
    <!-- Contenido dinámico -->
    <?php echo $contenido; ?>
</body>

</html>