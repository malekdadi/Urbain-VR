<?php
// read-pack.php

// Inclusion des fichiers nécessaires
require_once '../../config/database.php';
require_once '../../models/Pack.php';

// Récupérer l'ID du pack depuis l'URL
$id_pack = isset($_GET['id']) ? $_GET['id'] : null;

$errors = [];

// Vérification de la validité de l'ID
if ($id_pack === null || !is_numeric($id_pack)) {
    $errors[] = "L'ID du pack est manquant ou invalide.";
}

$pack = null;

if (empty($errors)) {
    // Connexion à la base de données via config
    $conn = config::getConnexion(); // Utilisation de la méthode statique pour obtenir la connexion

    // Création de l'objet modèle
    $packModel = new Pack($conn);

    // Récupérer les détails du pack
    $pack = $packModel->getPackById($id_pack);
    
    if (!$pack) {
        $errors[] = "Pack introuvable.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Détails du Pack</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../../assets/css/main.css" rel="stylesheet">
</head>

<body>
<?php include '../../templates/header-views.php'; ?>
<?php include '../../templates/navbar-views.php'; ?>

<div class="container mt-4">
    <h2>Détails du Pack</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger mt-3">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($pack): ?>
        <div class="bg-light p-4 rounded shadow-sm">
        <h3><strong>Id du pack :</strong> <?= htmlspecialchars($pack['id_pack']) ?></h3>
            <p><strong>ID abonnement :</strong> <?= htmlspecialchars($pack['id_abon']) ?></p>
            <p><strong>Prix :</strong> <?= number_format($pack['prix'], 2, ',', ' ') ?> €</p>
        </div>

        <a href="../../index.php?action=packs" class="btn btn-secondary mt-3">Retour à la liste des packs</a>
    <?php endif; ?>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="../../assets/js/main-js.js"></script>

</body>
</html>
