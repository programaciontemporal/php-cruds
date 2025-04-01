<?php
ob_start();
?>
<h1>Agregar Cliente</h1>
<?php if ( isset( $error ) ) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<form method='post' action='index.php?accion=create'>
    <label>Nombre:</label>
    <input type='text' name='nombre' required><br><br>
    <label>Email:</label>
    <input type='email' name='email' required><br><br>
    <label>Teléfono:</label>
    <input type='text' name='telefono' required><br><br>
    <input type='submit' value='Agregar'>
</form>
<?php
$contenido = ob_get_clean();
include __DIR__ . '/../layout.php';
?>