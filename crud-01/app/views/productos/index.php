<?php
// app/views/productos/index.php
ob_start();
?>
<h1>Listado de Productos</h1>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($productos as $row): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['nombre']) ?></td>
        <td><?= htmlspecialchars($row['descripcion']) ?></td>
        <td><?= htmlspecialchars($row['precio']) ?></td>
        <td>
            <a href="index.php?modulo=producto&accion=update&id=<?= htmlspecialchars($row['id']) ?>">Editar</a> |
            <a href="index.php?modulo=producto&accion=delete&id=<?= htmlspecialchars($row['id']) ?>"
                onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php'; 
?>