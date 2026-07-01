<?php require __DIR__ . "/layout/header.php"; ?>

<div class="p-4 rounded shadow-sm" style="background-color: var(--blue-dark); color: white;">
    <h1 class="fw-bold">GEC Dashboard</h1>
    <p class="mb-0">
        Bienvenue sur le tableau de bord du système de gestion des étudiants et des classes. 
        Utilisez les sections ci-dessous pour naviguer et gérer les informations.

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="fw-bold" style="color: var(--blue-mid);">Étudiants</h3>
                <p class="text-muted">Gérer tous les étudiants enregistrés</p>
                <a href="index.php?page=students" class="btn btn-primary w-100">Voir les étudiants</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="fw-bold" style="color: var(--orange);">Classes</h3>
                <p class="text-muted">Voir et gérer toutes les classes</p>
                <a href="index.php?page=classes" class="btn btn-warning w-100">Voir les classes</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="fw-bold" style="color: var(--cyan-dark);">Inscriptions</h3>
                <p class="text-muted">Assigner une classe à un étudiant</p>
                <a href="index.php?page=enroll" class="btn btn-info w-100 text-white">Voir les inscriptions</a>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3" style="border-left: 5px solid var(--blue-light);">
            <h5>Total Étudiants</h5>
            <p class="fs-4 fw-bold"><?= $studentCount ?></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3" style="border-left: 5px solid var(--orange);">
            <h5>Total Classes</h5>
            <p class="fs-4 fw-bold"><?= $classCount ?></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3" style="border-left: 5px solid var(--cyan);">
            <h5>Total Inscriptions</h5>
            <p class="fs-4 fw-bold"><?= $enrollCount ?></p>
        </div>
    </div>

</div>

<?php require __DIR__ . "/layout/footer.php"; ?>
