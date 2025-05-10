<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Supprimer le pack</title>

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
  <h2>Supprimer le pack</h2>

  <?php
  require_once '../../models/Pack.php';
  $packmodel = new Pack();

  if (isset($_GET['id']) && !empty($_GET['id'])) {
      $id_pack = $_GET['id'];
      $pack = $packmodel->getPackById($id_pack);
  } else {
      echo "<div class='alert alert-danger'>ID pack manquant.</div>";
      exit;
  }

  if (!$pack) {
      echo "<div class='alert alert-danger'>Pack introuvable.</div>";
      exit;
  }

  // Traitement de la suppression
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $packmodel->deletePack($id_pack);
      echo "<div class='alert alert-success'>Pack supprimé avec succès.</div>";
      echo "<a href='../../index.php?action=packs' class='btn btn-success mt-2'>Retour à la liste des packs</a>";
      exit; // Terminer l'exécution après suppression
  }
  ?>

  <div class="bg-light p-4 rounded shadow-sm">
    <p>Êtes-vous sûr de vouloir supprimer ce pack ? Cette action est irréversible.</p>

    <div class="mb-3">
      <label class="form-label"><strong>ID :</strong></label>
      <p><?= htmlspecialchars($pack['id_pack']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>ID Utilisateur :</strong></label>
      <p><?= htmlspecialchars($pack['id_user']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>ID Abonnement :</strong></label>
      <p><?= htmlspecialchars($pack['id_abon']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>Prix :</strong></label>
      <p><?= htmlspecialchars($pack['prix']) ?></p>
    </div>

    <form method="post">
      <button type="submit" class="btn btn-danger">Supprimer ce pack</button>
      <a href="../../index.php?action=packs" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="../../assets/js/main.js"></script>
</body>
</html>
