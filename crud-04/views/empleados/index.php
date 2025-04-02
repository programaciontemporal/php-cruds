<h1>Empleados</h1>
<a href="index.php?controller=empleado&action=create">Nuevo Empleado</a>
<ul>
    <?php foreach ($empleados as $emp): ?>
    <li>
        <?= $emp['nombre'] ?> (<?= $emp['email'] ?>) - <?= $emp['departamento'] ?>
        | <a href="index.php?controller=empleado&action=edit&id=<?= $emp['id'] ?>">Editar</a>
        | <a href="index.php?controller=empleado&action=delete&id=<?= $emp['id'] ?>">Eliminar</a>
    </li>
    <?php endforeach; ?>
</ul>