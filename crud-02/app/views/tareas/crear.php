<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Crear Nueva Tarea</h4>
    </div>
    <div class="card-body">
        <form action="index.php?action=guardar" method="post">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text"
                    class="form-control <?= isset($errores) && in_array('La descripción es obligatoria', $errores) ? 'is-invalid' : '' ?>"
                    id="descripcion" name="descripcion" required
                    value="<?= isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '' ?>">
                <?php if (isset($errores) && in_array('La descripción es obligatoria', $errores)): ?>
                <div class="invalid-feedback">La descripción es obligatoria</div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="fecha_limite" class="form-label">Fecha Límite</label>
                <input type="date"
                    class="form-control <?= isset($errores) && in_array('La fecha límite no es válida', $errores) ? 'is-invalid' : '' ?>"
                    id="fecha_limite" name="fecha_limite" required
                    value="<?= isset($_POST['fecha_limite']) ? htmlspecialchars($_POST['fecha_limite']) : '' ?>">
                <?php if (isset($errores) && in_array('La fecha límite no es válida', $errores)): ?>
                <div class="invalid-feedback">La fecha límite no es válida</div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="pendiente"
                        <?= (isset($_POST['estado']) && $_POST['estado'] == 'pendiente') ? 'selected' : '' ?>>Pendiente
                    </option>
                    <option value="completada"
                        <?= (isset($_POST['estado']) && $_POST['estado'] == 'completada') ? 'selected' : '' ?>>
                        Completada</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <a href="index.php?action=index" class="btn btn-outline-secondary me-2">
                    <i class="bi bi-x-lg me-1"></i>Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Guardar Tarea
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>