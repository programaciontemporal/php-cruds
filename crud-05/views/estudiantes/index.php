<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listado de Estudiantes</h1>
    <a href="index.php?controller=Estudiante&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Estudiante
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantes as $estudiante): ?>
            <tr>
                <td><?= htmlspecialchars($estudiante['id']) ?></td>
                <td><?= htmlspecialchars($estudiante['nombre']) ?></td>
                <td><?= htmlspecialchars($estudiante['apellido']) ?></td>
                <td><?= htmlspecialchars($estudiante['email']) ?></td>
                <td><?= htmlspecialchars($estudiante['fecha_creacion']) ?></td>
                <td>
                    <a href="index.php?controller=Estudiante&action=show&id=<?= $estudiante['id'] ?>"
                        class="btn btn-sm btn-info" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?controller=Estudiante&action=edit&id=<?= $estudiante['id'] ?>"
                        class="btn btn-sm btn-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="index.php?controller=Estudiante&action=delete&id=<?= $estudiante['id'] ?>"
                        method="POST" style="display: inline;"
                        onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?');">
                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layout.php'; 
?>