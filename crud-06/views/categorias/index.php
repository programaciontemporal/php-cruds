<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listado de Categorías</h1>
    <a href="index.php?controller=Categoria&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva Categoría
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="table-dark">
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= htmlspecialchars($categoria['id']) ?></td>
                <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
                <td><?= $this->categoriaModel->countProductos($categoria['id']) ?></td>
                <td>
                    <a href="index.php?controller=Categoria&action=show&id=<?= $categoria['id'] ?>"
                        class="btn btn-sm btn-info" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?controller=Categoria&action=edit&id=<?= $categoria['id'] ?>"
                        class="btn btn-sm btn-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="index.php?controller=Categoria&action=delete&id=<?= $categoria['id'] ?>" method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
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