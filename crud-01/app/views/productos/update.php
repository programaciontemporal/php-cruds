<?php
ob_start();
?>
<h1>Editar Producto</h1>
<?php if (isset($error)): ?>
<p style='color:red;'><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method='post' action='index.php?modulo=producto&accion=update'>
    <input type='hidden' name='id' value="<?= htmlspecialchars($producto['id']) ?>">

    <label>Nombre:</label>
    <input type='text' name='nombre' value="<?= htmlspecialchars($producto['nombre']) ?>" required>

    <label>Descripción:</label>
    <textarea name='descripcion' required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

    <label>Precio:</label>
    <input type='number' step="0.01" name='precio' value="<?= htmlspecialchars($producto['precio']) ?>" required>

    <input type='submit' value='Actualizar'>
</form>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php';
?>