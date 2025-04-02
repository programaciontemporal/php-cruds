<?php ob_start(); ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Nuevo Producto</h2>
    </div>
    <div class="card-body">
        <form action="index.php?controller=Producto&action=create" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=Producto&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layout.php'; ?>