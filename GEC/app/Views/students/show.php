<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-dark);">
        <h4 class="mb-0">Détails de l'Étudiant</h4>
    </div>

    <div class="card-body">

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>INE:</strong>
                <p><?= $student['INE'] ?></p>
            </div>

            <div class="col-md-6">
                <strong>Name:</strong>
                <p><?= ucfirst($student['Fname']) . " " . strtoupper($student['Lname']) ?></p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Email:</strong>
                <p><?= $student['Email'] ?></p>
            </div>

            <div class="col-md-6">
                <strong>Phone:</strong>
                <p><?= $student['PhoneNumber'] ?></p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Gender:</strong>
                <p><?= $student['Gender'] ?></p>
            </div>

            <div class="col-md-6">
                <strong>Birthdate:</strong>
                <p><?= $student['Birthdate'] ?? "<em>Not provided</em>" ?></p>
            </div>
        </div>

        <a href="index.php?page=students" class="btn btn-primary">Back to list</a>
        <a href="index.php?page=student_edit&ine=<?= $student['INE'] ?>" class="btn btn-warning">Edit</a>
        <a href="index.php?page=student_delete&ine=<?= $student['INE'] ?>" class="btn btn-danger">Delete</a>

    </div>

    <h3 class="mt-4">Historique des inscriptions</h3>

    <?php if (empty($history)): ?>
        <p class="text-muted">Aucune inscription trouvée.</p>
    <?php else: ?>

        <ul class="timeline">

            <?php foreach ($history as $h): ?>
                <li class="timeline-item">
                    <span class="timeline-date">
                        <?= date("Y", strtotime($h['Enroll_date'])) ?> -
                        <?= date("Y", strtotime($h['End_date'])) ?>
                    </span>

                    <div class="timeline-content">
                        <strong><?= $h['ClassName'] ?></strong><br>
                        <span class="badge bg-primary"><?= $h['statuts'] ?></span>
                    </div>
                </li>
            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
