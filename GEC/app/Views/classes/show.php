<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-dark);">
        <h4 class="mb-0">Class Details</h4>
    </div>

    <div class="card-body">

        <p><strong>ID:</strong> <?= $class['idClass'] ?></p>
        <p><strong>Name:</strong> <?= $class['ClassName'] ?></p>
        <p><strong>Curriculum:</strong> <?= $class['Curriculum'] ?></p>
        <p><strong>Level:</strong> <?= $class['idLevel'] ?></p>
        <p><strong>Start Year:</strong> <?= $class['StartYear'] ?></p>
        <p><strong>End Year:</strong> <?= $class['EndYear'] ?></p>

        <hr>

        <h5>Students in this class</h5>

        <?php if (empty($students)): ?>
            <p><em>No students enrolled.</em></p>
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
