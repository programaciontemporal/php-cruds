<?php ob_start(); ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Nuevo Curso</h2>
    </div>
    <div class="card-body">
        <form action="index.php?controller=Curso&action=create" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="creditos" class="form-label">Créditos</label>
                <input type="number" class="form-control" id="creditos" name="creditos" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=Curso&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean(); 
include __DIR__ . '/../layout.php';
?>