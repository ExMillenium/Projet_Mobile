<?php require __DIR__ . "/../layout/header.php"; ?>

<h1>Students</h1>

<a href="index.php?page=student_add">Add Student</a>

<table border="1" cellpadding="8">
    <tr>
        <th>INE</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['INE'] ?></td>
            <td><?= $s['Fname'] . " " . $s['Lname'] ?></td>
            <td><?= $s['Email'] ?></td>
            <td><?= $s['PhoneNumber'] ?></td>
            <td>
                <a href="index.php?page=student_show&ine=<?= $s['INE'] ?>">View</a>
                <a href="index.php?page=student_edit&ine=<?= $s['INE'] ?>">Edit</a>
                <a href="index.php?page=student_delete&ine=<?= $s['INE'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>