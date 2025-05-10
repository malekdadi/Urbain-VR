<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php"); // Redirige vers la page de connexion admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Packs - Admin</title>

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

<?php
include '../../templates/header-dashboard.php';
include '../../templates/navbar-models.php';
include '../../config/database.php';
require_once '../../models/Pack.php';

// Connexion DB
$db = new config();
$conn = $db->getConnexion();

$packModel = new Pack($conn);

// Récupération des statistiques sur les packs
$totalPacks = $packModel->countPacks();
$availablePacks = $packModel->countAvailablePacks(); // suppose une méthode qui compte les packs disponibles
$unavailablePacks = $totalPacks - $availablePacks;

// Données fictives pour graphique (à remplacer par DB plus tard)
$packCreations = [5, 8, 6, 10, 7, 12]; // nombre de packs créés par mois (exemple)
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
          <a href="packs.php" class="btn btn-success">📦 Packs</a> <!-- actif -->
          <a href="reclamations.php" class="btn btn-outline-danger">🛠️ Réclamations</a>
        </div>
      </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="col-md-9">
      <h3 class="mb-4">📦 Statistiques des packs</h3>

      <div class="row mb-4">
        <div class="col-md-6 col-lg-4">
          <div class="card text-white bg-success mb-3">
            <div class="card-body">
              <h5 class="card-title">Total Packs</h5>
              <p class="card-text fs-3"><?= $totalPacks ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-white bg-info mb-3">
            <div class="card-body">
              <h5 class="card-title">Packs disponibles</h5>
              <p class="card-text fs-3"><?= $availablePacks ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
              <h5 class="card-title">Packs indisponibles</h5>
              <p class="card-text fs-3"><?= $unavailablePacks ?></p>
            </div>
          </div>
        </div>
      </div>

      <!-- GRAPHIQUE -->
      <div class="card p-4 my-4" style="max-width: 100%; height: 600px;">
        <h5 class="card-title">📈 Évolution des packs par mois</h5>
        <div style="position: relative; height: 100%; width: 100%;">
          <canvas id="packChart"></canvas>
        </div>
      </div>

    </div> <!-- END MAIN CONTENT -->
  </div>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('packChart').getContext('2d');
  const packChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nouveaux packs',
        data: <?= json_encode($packCreations) ?>,
        backgroundColor: 'rgba(40, 167, 69, 0.7)', // vert
        borderColor: '#28a745',
        borderWidth: 1
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

</body>
</html>
