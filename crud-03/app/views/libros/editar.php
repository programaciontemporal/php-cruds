<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Libro</h4>
    </div>
    <div class="card-body">
        <form action="index.php?action=actualizar" method="post">
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control <?= isset($errores) && in_array('El título es obligatorio', $errores) ? 'is-invalid' : '' ?>" 
                       id="titulo" name="titulo" required
                       value="<?= htmlspecialchars($libro['titulo']) ?>">
                <?php if (isset($errores) && in_array('El título es obligatorio', $errores)): ?>
                    <div class="invalid-feedback">El título es obligatorio</div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control <?= isset($errores) && in_array('El autor es obligatorio', $errores) ? 'is-invalid' : '' ?>" 
                       id="autor" name="autor" required
                       value="<?= htmlspecialchars($libro['autor']) ?>">
                <?php if (isset($errores) && in_array('El autor es obligatorio', $errores)): ?>
                    <div class="invalid-feedback">El autor es obligatorio</div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="anio_publicacion" class="form-label">Año de Publicación</label>
                <input type="number" class="form-control <?= isset($errores) && in_array('El año de publicación no es válido', $errores) ? 'is-invalid' : '' ?>" 
                       id="anio_publicacion" name="anio_publicacion" required
                       value="<?= $libro['anio_publicacion'] ?>">
                <?php if (isset($errores) && in_array('El año de publicación no es válido', $errores)): ?>
                    <div class="invalid-feedback">El año de publicación no es válido</div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-end">
                <a href="index.php?action=index" class="btn btn-outline-secondary me-2">
                    <i class="bi bi-x-lg me-1"></i>Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Actualizar Libro
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>