<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-mid);">
        <h4 class="mb-0">Ajouter une Classe</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=class_add_submit" method="POST" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">ID de la Classe</label>
                <input type="text" name="idClass" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom de la Classe</label>
                <input type="text" name="ClassName" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Curriculum</label>
                <input type="text" name="Curriculum" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Niveau Académique</label>
                <input type="text" name="idLevel" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Année de Début</label>
                <input type="number" name="StartYear" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Année de Fin</label>
                <input type="number" name="EndYear" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="index.php?page=classes" class="btn btn-secondary">Annuler</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
