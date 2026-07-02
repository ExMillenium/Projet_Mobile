<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-mid);">
        <h4 class="mb-0">Inscrire un étudiant</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=enroll_add_submit" method="POST" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Étudiant</label>
                <select name="StudentINE" class="form-select" required>
                    <option value="">Sélectionner un étudiant</option>
                    <?php foreach ($students as $s): ?>
                        <option value="<?= $s['INE'] ?>">
                            <?= $s['Fname'] . " " . $s['Lname'] ?> (<?= $s['INE'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Classe</label>
                <select name="ClassEnrolled" class="form-select" required>
                    <option value="">Sélectionner une classe</option>
                    <?php foreach ($classes as $c): ?>
                        <option value="<?= $c['idClass'] ?>">
                            <?= $c['ClassName'] ?> (<?= $c['idClass'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date d'inscription</label>
                <input type="date" name="Enroll_date" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date de fin</label>
                <input type="date" name="End_date" class="form-control" required>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="index.php?page=enroll" class="btn btn-secondary">Annuler</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
