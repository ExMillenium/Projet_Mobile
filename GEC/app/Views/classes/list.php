<?php require __DIR__ . "/../layout/header.php"; ?>

<h1 class="mb-4">Classes</h1>

<a href="index.php?page=class_add" class="btn btn-primary mb-3">Add Class</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Curriculum</th>
            <th>Level</th>
            <th>Start</th>
            <th>End</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($classes as $c): ?>
        <tr>
            <td><?= $c['idClass'] ?></td>
            <td><?= $c['ClassName'] ?></td>
            <td><?= $c['Curriculum'] ?></td>
            <td><?= $c['idLevel'] ?></td>
            <td><?= $c['StartYear'] ?></td>
            <td><?= $c['EndYear'] ?></td>
            <td>
                <a href="index.php?page=class_show&id=<?= $c['idClass'] ?>" class="btn btn-warning btn-sm">View</a>
                <a href="index.php?page=class_edit&id=<?= $c['idClass'] ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="index.php?page=class_delete&id=<?= $c['idClass'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>
