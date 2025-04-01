<?php
ob_start();
?>
<h1>Editar Cliente</h1>
<?php if ( isset( $error ) ) {

    echo "<p style='color:red;'>$error</p>";
}
?>
<form method='post' action='index.php?accion=update'>
    <input type='hidden' name='id' value="<?php echo htmlspecialchars($cliente['id']); ?>">
    <label>Nombre:</label>
    <input type='text' name='nombre' value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required><br><br>
    <label>Email:</label>
    <input type='email' name='email' value="<?php echo htmlspecialchars($cliente['email']); ?>" required><br><br>
    <label>Teléfono:</label>
    <input type='text' name='telefono' value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required><br><br>
    <input type='submit' value='Actualizar'>
</form>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php';
?>