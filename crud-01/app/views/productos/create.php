<?php
ob_start();
?>
<h1>Agregar Producto</h1>
<?php if (isset($error)): ?>
<p style='color:red;'><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method='post' action='index.php?modulo=producto&accion=create'>
    <label>Nombre:</label>
    <input type='text' name='nombre' value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>"
        required>

    <label>Descripción:</label>
    <textarea name='descripcion'
        required><?= isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '' ?></textarea>

    <label>Precio:</label>
    <input type='number' step="0.01" name='precio'
        value="<?= isset($_POST['precio']) ? htmlspecialchars($_POST['precio']) : '' ?>" required>

    <input type='submit' value='Agregar'>
</form>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php';
?>