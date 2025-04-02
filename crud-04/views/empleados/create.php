<h1>Nuevo Empleado</h1>
<form method="post" action="index.php?controller=empleado&action=store">
    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <select name="departamento_id">
        <?php foreach ($departamentos as $dep): ?>
        <option value="<?= $dep['id'] ?>"><?= $dep['nombre'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Guardar</button>
</form>