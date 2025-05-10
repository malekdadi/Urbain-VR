<?php
// packs.php

// Déclaration des packs directement dans la page
$packs = [
    [
        'nom' => 'Pack Gratuit',
        'prix' => 0,
        'description' => '1 seule visite',
    ],
    [
        'nom' => 'Pack Standard',
        'prix' => 49,
        'description' => '5 visites',
    ],
    [
        'nom' => 'Pack Premium',
        'prix' => 150,
        'description' => 'visite infinies',
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Nos Packs</title>

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

    <!-- Custom CSS -->
    <style>
        .pack-card {
            background-color: #28a745; /* Vert */
            color: white; /* Texte blanc pour contraster avec le vert */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pack-card:hover {
            transform: translateY(-5px); /* Effet de survol */
        }

        .pack-card .card-body {
            padding: 20px;
        }

        .pack-card .card-title {
            font-weight: bold;
            font-size: 1.25rem;
        }

        .pack-card .card-text {
            font-size: 1rem;
        }

        .pack-card .btn-primary {
            background-color: #1e7e34; /* Vert plus foncé */
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .pack-card .btn-primary:hover {
            background-color: #155d27; /* Vert encore plus foncé au survol */
        }
    </style>
</head>

<body>
<?php include '../../templates/header.php'; ?>
<?php include '../../templates/navbar.php'; ?>




<div class="container mt-4">
    <h2>Nos Packs</h2>


    <div class="row">
        <?php foreach ($packs as $pack): ?>
            <div class="col-md-4 mb-4">
                <div class="card pack-card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($pack['nom']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($pack['description']) ?></p>
                        <h6 class="card-subtitle mb-2"><?= number_format($pack['prix'], 2, ',', ' ') ?> Dinars</h6>
                        <form action="../../Controllers/AchatController.php" method="POST">
                            <input type="hidden" name="utilisateur_id" value="1"> <!-- Exemple d'utilisateur -->
                            <input type="hidden" name="pack_id" value="<?= htmlspecialchars($pack['nom']) ?>">
                            <input type="hidden" name="prix" value="<?= htmlspecialchars($pack['prix']) ?>">
                            <button type="submit" class="btn btn-primary">Choisir ce pack</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php include '../../templates/footer.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>
<script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
</body>
</html>

<?php
// filepath: c:\xampp\htdocs\pack\Controllers\ExportController.php
include '../../config/database.php';

if ($_GET['format'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=rapport_packs.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Nom du Pack', 'Total Achats', 'Total Revenu']);

    $result = $conn->query("SELECT p.nom, COUNT(a.id) AS total_achats, SUM(a.prix) AS total_revenu
                            FROM achats a
                            JOIN packs p ON a.pack_id = p.id
                            GROUP BY p.nom");

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['nom'], $row['total_achats'], $row['total_revenu']]);
    }

    fclose($output);
    exit;
}
?>

