<?php
// app/views/clientes/index.php
ob_start();
?>
<h1>Listado de Clientes</h1>
<table border='1' cellpadding='10'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($clientes as $row): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['nombre']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['telefono']) ?></td>
        <td>
            <a href="index.php?modulo=cliente&accion=update&id=<?= htmlspecialchars($row['id']) ?>">Editar</a> |
            <a href="index.php?modulo=cliente&accion=delete&id=<?= htmlspecialchars($row['id']) ?>"
                onclick="return confirm('¿Está seguro de eliminar este cliente?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php'; // IMPORTANTE: Descomentar esta línea
?>