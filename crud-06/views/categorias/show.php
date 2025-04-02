<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalles de la Categoría</h2>
        <div>
            <a href="index.php?controller=Categoria&action=edit&id=<?= $categoria['id'] ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="index.php?controller=Categoria&action=index" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Información</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Nombre:</strong> <?= htmlspecialchars($categoria['nombre']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Descripción:</strong> <?= htmlspecialchars($categoria['descripcion']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Creación:</strong> <?= htmlspecialchars($categoria['fecha_creacion']) ?>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h4>Productos Asociados (<?= count($productos) ?>)</h4>
                <?php if (empty($productos)): ?>
                <div class="alert alert-info">No hay productos en esta categoría.</div>
                <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($productos as $producto): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($producto['nombre']) ?>
                        <span class="badge bg-primary rounded-pill float-end">
                            <?= $producto['stock'] ?> en stock
                        </span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layout.php'; ?>