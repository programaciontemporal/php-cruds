<?php ob_start(); ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Estudiante</h2>
    </div>
    <div class="card-body">
        <form action="index.php?controller=Estudiante&action=edit&id=<?= $estudiante['id'] ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?= htmlspecialchars($estudiante['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido"
                    value="<?= htmlspecialchars($estudiante['apellido']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($estudiante['email']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php?controller=Estudiante&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layout.php'; 
?>