<h1>Departamentos</h1>
<a href="index.php?controller=departamento&action=create">Nuevo Departamento</a>
<ul>
    <?php foreach ($departamentos as $dep): ?>
        <li>
            <?= $dep['nombre'] ?> |
            <a href="index.php?controller=departamento&action=edit&id=<?= $dep['id'] ?>">Editar</a> |
            <a href="index.php?controller=departamento&action=delete&id=<?= $dep['id'] ?>">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>
