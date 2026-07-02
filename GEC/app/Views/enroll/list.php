<?php require __DIR__ . "/../layout/header.php"; ?>

<h1 class="mb-4">Enrollments</h1>

<a href="index.php?page=enroll_add" class="btn btn-primary mb-3">Enroll Student</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Etudiant</th>
            <th>Classe</th>
            <th>Date d'Inscription</th>
            <th>Date de Fin</th>
            <th>Statut</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($enrollments as $e): ?>
        <tr>
            <td><?= $e['Fname'] . " " . $e['Lname'] ?> (<?= $e['StudentINE'] ?>)</td>
            <td><?= $e['ClassName'] ?> (<?= $e['ClassEnrolled'] ?>)</td>
            <td><?= $e['Enroll_date'] ?></td>
            <td><?= $e['End_date'] ?></td>
            <td><?= $e['statuts'] ?></td>
            <td>
                <a href="index.php?page=enroll_edit&ine=<?= $e['StudentINE'] ?>&class=<?= $e['ClassEnrolled'] ?>" 
                    class="btn btn-warning btn-sm">Modifier</a>


                <a href="index.php?page=enroll_delete&ine=<?= $e['StudentINE'] ?>&class=<?= $e['ClassEnrolled'] ?>" 
                   class="btn btn-danger btn-sm">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>
