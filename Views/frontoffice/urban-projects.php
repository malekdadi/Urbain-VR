<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<div class="container mt-4">
    <h2>Nos projets urbains</h2>

    <?php foreach ($urbanProjects as $project): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($project['nom_projet']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($project['description']) ?></p>
                <a href="urban-project-details.php?id=<?= $project['id_projet'] ?>" class="btn btn-primary">Voir le projet</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php include 'templates/footer.php'; ?>
