<?php require __DIR__ . "/../layout/header.php"; ?>

<h1>Étudiants</h1>
<h2><button href="index.php?page=student_add" class="btn btn-primary">Ajouter un Étudiant</button></h2>
<br/>
<table border="1" cellpadding="8">
    <tr>
        <th>Identifiant National Etudiant (INE)</th>
        <th>Prénom et Nom</th>
        <th>Email</th>
        <th>Numéro de Téléphone</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['INE'] ?></td>
            <td><?= $s['Fname'] . " " . $s['Lname'] ?></td>
            <td><?= $s['Email'] ?></td>
            <td><?= $s['PhoneNumber'] ?></td>
            <td>
                <button href="index.php?page=student_show&ine=<?= $s['INE'] ?>" class="btn btn-info btn-sm">View</button>
                <br/>
                <button href="index.php?page=student_edit&ine=<?= $s['INE'] ?>" class="btn btn-warning btn-sm">Edit</button>
                <br/>
                <button href="index.php?page=student_delete&ine=<?= $s['INE'] ?>" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>