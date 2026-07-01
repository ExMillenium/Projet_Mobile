<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--orange);">
        <h4 class="mb-0">Modifier l'inscription</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=enroll_edit_submit" method="POST" class="row g-3">

            <!-- Hidden keys -->
            <input type="hidden" name="StudentINE" value="<?= $enroll['StudentINE'] ?>">
            <input type="hidden" name="ClassEnrolled" value="<?= $enroll['ClassEnrolled'] ?>">

            <!-- Dates -->
            <div class="col-md-6">
                <label class="form-label">Date d'inscription</label>
                <input type="date" name="Enroll_date" class="form-control" 
                       value="<?= $enroll['Enroll_date'] ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date de fin</label>
                <input type="date" name="End_date" class="form-control" 
                       value="<?= $enroll['End_date'] ?>" required>
            </div>

            <!-- Statut -->
            <div class="col-md-12">
                <label class="form-label">Statut</label>

                <?php
                    // Tous les statuts sauf "Actif"
                    $options = ['Terminé','Diplômé','Abandon','Échec','Transféré','Exclu','Suspendu'];
                ?>

                <select name="statuts" class="form-select" required>
                    <?php foreach ($options as $opt): ?>
                        <option value="<?= $opt ?>" <?= ($opt == $enroll['statuts']) ? 'selected' : '' ?>>
                            <?= $opt ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <small class="text-muted">
                    Le statut "Actif" ne peut pas être réattribué une fois quitté.
                </small>
            </div>

            <!-- Buttons -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="index.php?page=enroll" class="btn btn-secondary">Annuler</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
