<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalles del Estudiante</h2>
        <div>
            <a href="index.php?controller=Estudiante&action=edit&id=<?= $estudiante['id'] ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="index.php?controller=Estudiante&action=index" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Información Personal</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Nombre:</strong> <?= htmlspecialchars($estudiante['nombre']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Apellido:</strong> <?= htmlspecialchars($estudiante['apellido']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> <?= htmlspecialchars($estudiante['email']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Creación:</strong> <?= htmlspecialchars($estudiante['fecha_creacion']) ?>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h4>Cursos Inscritos</h4>
                <?php if (empty($cursos)): ?>
                <div class="alert alert-info">El estudiante no está inscrito en ningún curso.</div>
                <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($cursos as $curso): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($curso['nombre']) ?>
                        <span class="badge bg-primary rounded-pill"><?= $curso['creditos'] ?> créditos</span>
                        <form
                            action="index.php?controller=Estudiante&action=removeCurso&estudiante_id=<?= $estudiante['id'] ?>&curso_id=<?= $curso['id'] ?>"
                            method="POST" style="display: inline;">
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Asignar Nuevo Curso</h4>
            </div>
            <div class="card-body">
                <?php if (empty($cursosDisponibles)): ?>
                <div class="alert alert-info">No hay cursos disponibles para asignar.</div>
                <?php else: ?>
                <form action="index.php?controller=Estudiante&action=addCurso&id=<?= $estudiante['id'] ?>"
                    method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <select class="form-select" name="curso_id" required>
                                <option value="">Seleccione un curso</option>
                                <?php foreach ($cursosDisponibles as $curso): ?>
                                <option value="<?= $curso['id'] ?>">
                                    <?= htmlspecialchars($curso['nombre']) ?> (<?= $curso['creditos'] ?> créditos)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Asignar Curso
                            </button>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layout.php'; 
?>