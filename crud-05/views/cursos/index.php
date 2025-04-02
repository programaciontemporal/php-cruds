<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listado de Cursos</h1>
    <a href="index.php?controller=Curso&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Curso
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Créditos</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso): ?>
            <tr>
                <td><?= htmlspecialchars($curso['id']) ?></td>
                <td><?= htmlspecialchars($curso['nombre']) ?></td>
                <td><?= htmlspecialchars($curso['creditos']) ?></td>
                <td><?= htmlspecialchars($curso['fecha_creacion']) ?></td>
                <td>
                    <a href="index.php?controller=Curso&action=show&id=<?= $curso['id'] ?>" class="btn btn-sm btn-info"
                        title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?controller=Curso&action=edit&id=<?= $curso['id'] ?>"
                        class="btn btn-sm btn-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="index.php?controller=Curso&action=delete&id=<?= $curso['id'] ?>" method="POST"
                        style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
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