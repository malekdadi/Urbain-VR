<?php include '../../templates/header-front.php'; ?>
<?php include '../../templates/navbar-views.php'; ?>

<div class="container mt-4">
    <h2>Nos Packs</h2>

    <?php foreach ($packs as $pack): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($pack['nom']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($pack['description']) ?></p>
                <p><strong>Prix : </strong><?= htmlspecialchars($pack['prix']) ?>€</p>
                <a href="contact.php" class="btn btn-primary">Acheter ce pack</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../../templates/footer-views.php'; ?>
