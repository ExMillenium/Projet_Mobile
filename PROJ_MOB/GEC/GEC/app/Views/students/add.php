<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-mid);">
        <h4 class="mb-0">Ajouter un Nouvel Étudiant</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=student_add_submit" method="POST" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Identifiant National Etudiant (INE)</label>
                <input type="text" name="INE" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Jour de Naissance</label>
                <input type="date" name="Birthdate" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="Fname" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="Lname" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Sexe</label>
                <select name="Gender" class="form-select">
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Numéro de Téléphone</label>
                <input type="text" name="PhoneNumber" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Ajouter l'étudiant</button>
                <a href="index.php?page=students" class="btn btn-secondary">Annuler</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
