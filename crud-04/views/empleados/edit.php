<h1>Editar Empleado</h1>
<form method="post" action="index.php?controller=empleado&action=update">
    <input type="hidden" name="id" value="<?= $empleado['id'] ?>">
    <input type="text" name="nombre" value="<?= $empleado['nombre'] ?>"><br>
    <input type="email" name="email" value="<?= $empleado['email'] ?>"><br>
    <select name="departamento_id">
        <?php foreach ($departamentos as $dep): ?>
        <option value="<?= $dep['id'] ?>" <?= $dep['id'] == $empleado['departamento_id'] ? 'selected' : '' ?>>
            <?= $dep['nombre'] ?>
        </option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Actualizar</button>
</form>