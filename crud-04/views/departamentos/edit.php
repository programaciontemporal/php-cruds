<h1>Editar Departamento</h1>
<form method="post" action="index.php?controller=departamento&action=update">
    <input type="hidden" name="id" value="<?= $departamento['id'] ?>">
    <input type="text" name="nombre" value="<?= $departamento['nombre'] ?>">
    <button type="submit">Actualizar</button>
</form>
