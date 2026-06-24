<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--blue-mid);">
        <h4 class="mb-0">Add Class</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=class_add_submit" method="POST" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Class ID</label>
                <input type="text" name="idClass" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Class Name</label>
                <input type="text" name="ClassName" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Curriculum</label>
                <input type="text" name="Curriculum" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Level</label>
                <input type="text" name="idLevel" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Start Year</label>
                <input type="number" name="StartYear" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">End Year</label>
                <input type="number" name="EndYear" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="index.php?page=classes" class="btn btn-secondary">Cancel</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
