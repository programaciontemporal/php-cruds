<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listado de Productos</h1>
    <a href="index.php?controller=Producto&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="table-dark">
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= htmlspecialchars($producto['id']) ?></td>
                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                <td><?= number_format($producto['precio'], 2) ?>€</td>
                <td><?= htmlspecialchars($producto['stock']) ?></td>
                <td><?= htmlspecialchars($producto['categoria_nombre']) ?></td>
                <td>
                    <a href="index.php?controller=Producto&action=show&id=<?= $producto['id'] ?>"
                        class="btn btn-sm btn-info" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?controller=Producto&action=edit&id=<?= $producto['id'] ?>"
                        class="btn btn-sm btn-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="index.php?controller=Producto&action=delete&id=<?= $producto['id'] ?>" method="POST"
                        style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
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

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layout.php'; ?>