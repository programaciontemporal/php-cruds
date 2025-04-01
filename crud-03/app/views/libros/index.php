<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book me-2"></i>Listado de Libros</h2>
    <a href="index.php?action=crear" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Libro
    </a>
</div>

<?php if ($libros->rowCount() > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php while ($libro = $libros->fetch()): ?>
            <div class="col">
                <div class="card book-card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($libro['autor']) ?></h6>
                        <p class="card-text">
                            <span class="badge bg-info"><?= $libro['anio_publicacion'] ?></span>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-end">
                            <a href="index.php?action=editar&id=<?= $libro['id'] ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="index.php?action=eliminar&id=<?= $libro['id'] ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?')">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
            <h5 class="card-title mt-3">No hay libros registrados</h5>
            <p class="card-text">Comienza agregando un nuevo libro</p>
            <a href="index.php?action=crear" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Agregar Libro
            </a>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>