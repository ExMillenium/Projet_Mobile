<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--orange);">
        <h4 class="mb-0">Edit Class</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=class_edit_submit" method="POST" class="row g-3">

            <input type="hidden" name="idClass" value="<?= $class['idClass'] ?>">

            <div class="col-md-6">
                <label class="form-label">Class Name</label>
                <input type="text" name="ClassName" class="form-control" value="<?= $class['ClassName'] ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Curriculum</label>
                <input type="text" name="Curriculum" class="form-control" value="<?= $class['Curriculum'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Level</label>
                <input type="text" name="idLevel" class="form-control" value="<?= $class['idLevel'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Start Year</label>
                <input type="number" name="StartYear" class="form-control" value="<?= $class['StartYear'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">End Year</label>
                <input type="number" name="EndYear" class="form-control" value="<?= $class['EndYear'] ?>">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php?page=classes" class="btn btn-secondary">Cancel</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
