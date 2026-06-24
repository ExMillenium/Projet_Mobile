<?php require __DIR__ . "/../layout/header.php"; ?>

<div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: var(--orange);">
        <h4 class="mb-0">Edit Student</h4>
    </div>

    <div class="card-body">

        <form action="index.php?page=student_edit_submit" method="POST" class="row g-3">

            <input type="hidden" name="INE" value="<?= $student['INE'] ?>">

            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="Fname" class="form-control" value="<?= $student['Fname'] ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="Lname" class="form-control" value="<?= $student['Lname'] ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Birthdate</label>
                <input type="date" name="Birthdate" class="form-control" value="<?= $student['Birthdate'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select name="Gender" class="form-select">
                    <option value="H" <?= $student['Gender'] === 'H' ? 'selected' : '' ?>>H</option>
                    <option value="F" <?= $student['Gender'] === 'F' ? 'selected' : '' ?>>F</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="PhoneNumber" class="form-control" value="<?= $student['PhoneNumber'] ?>">
            </div>

            <div class="col-md-12">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" value="<?= $student['Email'] ?>">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
            </div>

        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
