<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalles del Curso</h2>
        <div>
            <a href="index.php?controller=Curso&action=edit&id=<?= $curso['id'] ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="index.php?controller=Curso&action=index" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Información del Curso</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Nombre:</strong> <?= htmlspecialchars($curso['nombre']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Descripción:</strong> <?= htmlspecialchars($curso['descripcion']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Créditos:</strong> <?= htmlspecialchars($curso['creditos']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Creación:</strong> <?= htmlspecialchars($curso['fecha_creacion']) ?>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h4>Estudiantes Inscritos</h4>
                <?php if (empty($estudiantes)): ?>
                <div class="alert alert-info">No hay estudiantes inscritos en este curso.</div>
                <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($estudiantes as $estudiante): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($estudiante['nombre']) ?> <?= htmlspecialchars($estudiante['apellido']) ?>
                        <span class="badge bg-primary rounded-pill"><?= $estudiante['email'] ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>