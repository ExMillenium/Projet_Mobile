<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-dark);">
        <h4 class="mb-0">Détails de la Classe</h4>
    </div>

    <div class="card-body">

        <p><strong>ID:</strong> <?= $class['idClass'] ?></p>
        <p><strong>Nom:</strong> <?= $class['ClassName'] ?></p>
        <p><strong>Curriculum:</strong> <?= $class['Curriculum'] ?></p>
        <p><strong>Niveau:</strong> <?= $class['idLevel'] ?></p>
        <p><strong>Année de Début:</strong> <?= $class['StartYear'] ?></p>
        <p><strong>Année de Fin:</strong> <?= $class['EndYear'] ?></p>

        <hr>

        <h5>Étudiants dans cette classe</h5>

        <?php if (empty($students)): ?>
            <p><em>Aucun étudiant inscrit.</em></p>
        <?php else: ?>
            <ul>
                <?php foreach ($students as $s): ?>
                    <li><?= $s['Fname'] . " " . $s['Lname'] ?> (<?= $s['INE'] ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a href="index.php?page=classes" class="btn btn-primary mt-3">Back</a>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
