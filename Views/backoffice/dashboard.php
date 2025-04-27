<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../auth/login.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Admin</title>
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
<<?php
include '../../templates/header-dashboard.php';
include '../../templates/navbar-models.php';
include '../../config/database.php';
require_once '../../models/User.php';
require_once '../../models/UrbanProject.php';
require_once '../../models/Reclamation.php';
require_once '../../models/Pack.php';

// Connexion DB
$db = new Database();
$conn = $db->getConnection();

$userModel = new User($conn);
$projectModel = new UrbanProject($conn);
$reclamationModel = new Reclamation($conn);
$packModel = new Pack($conn);

// Récupération des statistiques
$totalUsers = $userModel->countUsers();
$totalProjects = $projectModel->countProjects();
$totalReclamations = $reclamationModel->countReclamations();
$totalPacks = $packModel->countPacks();
?>


<div class="container-fluid mt-4">
  <div class="row">

    <!-- SIDEBAR -->
<div class="col-md-3">
  <div class="p-4 rounded shadow-sm" style="background-color: #e6f4ea;">
    <h5 class="mb-4 text-success text-center">📂 Menu principal</h5>
    <div class="d-grid gap-3">
      <a href="list.php" class="btn btn-outline-primary">👤 Gérer les utilisateurs</a>
      <a href="urban-projects.php" class="btn btn-outline-secondary">🏙️ Voir les projets urbains</a>
      <a href="packs.php" class="btn btn-outline-success">📦 Packs</a>
      <a href="reclamations.php" class="btn btn-outline-danger">🛠️ Réclamations</a>
    </div>
  </div>
</div>


    <!-- MAIN CONTENT -->
    <div class="col-md-9">
      <h3 class="mb-4">📊 Statistiques générales</h3>
      <div class="row mb-4">
  <div class="col-md-6 col-lg-3">
    <div class="card text-white bg-primary mb-3">
      <div class="card-body">
        <h5 class="card-title">Utilisateurs</h5>
        <p class="card-text fs-3"><?= $totalUsers ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card text-white bg-secondary mb-3">
      <div class="card-body">
        <h5 class="card-title">Projets urbains</h5>
        <p class="card-text fs-3"><?= $totalProjects ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card text-white bg-danger mb-3">
      <div class="card-body">
        <h5 class="card-title">Réclamations</h5>
        <p class="card-text fs-3"><?= $totalReclamations ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card text-white bg-success mb-3">
      <div class="card-body">
        <h5 class="card-title">Packs</h5>
        <p class="card-text fs-3"><?= $totalPacks ?></p>
      </div>
    </div>
  </div>
</div>

     <!-- GRAPHIQUE -->
<div class="card p-4 my-4" style="max-width: 100%; height: 600px;">
  <h5 class="card-title">📈 Évolution des utilisateurs par mois</h5>
  <div style="position: relative; height: 100%; width: 100%;">
    <canvas id="userChart"></canvas>
  </div>
</div>


<?php include '../../templates/footer-views.php'; ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('userChart').getContext('2d');
  const userChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nouveaux utilisateurs',
        data: [12, 19, 7, 14, 20, 10], // Remplacer par des vraies données
        fill: true,
        borderColor: '#007bff',
        backgroundColor: 'rgba(0, 123, 255, 0.1)',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>