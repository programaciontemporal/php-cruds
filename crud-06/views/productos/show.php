<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalles del Producto</h2>
        <div>
            <a href="index.php?controller=Producto&action=edit&id=<?= $producto['id'] ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="index.php?controller=Producto&action=index" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Información Básica</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Nombre:</strong> <?= htmlspecialchars($producto['nombre']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Precio:</strong> <?= number_format($producto['precio'], 2) ?>€
                    </li>
                    <li class="list-group-item">
                        <strong>Stock:</strong> <?= htmlspecialchars($producto['stock']) ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Categoría</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['categoria_nombre']) ?></h5>
                        <a href="index.php?controller=Categoria&action=show&id=<?= $producto['categoria_id'] ?>"
                            class="btn btn-sm btn-outline-primary">
                            Ver categoría
                        </a>
                    </div>
                </div>
                <h4 class="mt-4">Fecha de Creación</h4>
                <p><?= htmlspecialchars($producto['fecha_creacion']) ?></p>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layout.php'; ?>