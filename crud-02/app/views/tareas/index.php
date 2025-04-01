<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-task me-2"></i>Listado de Tareas</h2>
    <a href="index.php?action=crear" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nueva Tarea
    </a>
</div>

<?php if ($tareas->rowCount() > 0): ?>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Fecha Límite</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($tarea = $tareas->fetch(PDO::FETCH_ASSOC)): ?>
            <tr class="<?= $tarea['estado'] == 'completada' ? 'table-secondary' : '' ?>">
                <td><?= $tarea['id'] ?></td>
                <td class="<?= $tarea['estado'] == 'completada' ? 'completed' : '' ?>">
                    <?= htmlspecialchars($tarea['descripcion']) ?>
                </td>
                <td>
                    <span
                        class="badge bg-<?= date('Y-m-d') > $tarea['fecha_limite'] && $tarea['estado'] != 'completada' ? 'danger' : 'secondary' ?>">
                        <?= date('d/m/Y', strtotime($tarea['fecha_limite'])) ?>
                    </span>
                </td>
                <td>
                    <span class="badge bg-<?= $tarea['estado'] == 'completada' ? 'success' : 'warning' ?>">
                        <?= ucfirst($tarea['estado']) ?>
                    </span>
                </td>
                <td class="text-end action-buttons">
                    <a href="index.php?action=editar&id=<?= $tarea['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="index.php?action=eliminar&id=<?= $tarea['id'] ?>" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
        <h5 class="card-title mt-3">No hay tareas registradas</h5>
        <p class="card-text">Comienza agregando una nueva tarea</p>
        <a href="index.php?action=crear" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Crear Tarea
        </a>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>