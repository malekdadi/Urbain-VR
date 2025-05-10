<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Modifier le pack</title>

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
  <h2>Modifier le pack</h2>

  <?php
  require_once '../../models/Pack.php';
  $packmodel = new Pack();

  if (isset($_GET['id']) && !empty($_GET['id'])) {
      $id_pack = $_GET['id'];
      $pack = $packmodel->getPackById($id_pack); // Fonction à créer pour récupérer le pack
  } else {
      echo "<div class='alert alert-danger'>ID pack manquant.</div>";
      exit;
  }

  if (!$pack) {
      echo "<div class='alert alert-danger'>Pack introuvable.</div>";
      exit;
  }

  // Traitement du formulaire
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_user = $_POST['id_user'];
      $id_abon = $_POST['id_abon'];
      $prix = $_POST['prix'];

      $packmodel->updatePack($id_pack, $id_user, $id_abon, $prix);
      echo "<div class='alert alert-success'>Pack mis à jour avec succès.</div>";
      // Tu peux aussi rediriger : header('Location: ../../index.php?action=packs');
  }
  ?>

  <form method="post" class="bg-light p-4 rounded shadow-sm">
    <div class="mb-3">
      <label class="form-label">ID Utilisateur</label>
      <input type="number" name="id_user" class="form-control" value="<?= htmlspecialchars($pack['id_user']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">ID Abonnement</label>
      <input type="number" name="id_abon" class="form-control" value="<?= htmlspecialchars($pack['id_abon']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Prix</label>
      <input type="number" name="prix" class="form-control" value="<?= htmlspecialchars($pack['prix']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    <a href="../../index.php?action=packs" class="btn btn-secondary">Annuler</a>
  </form>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>
<!-- Main JS File -->
<script src="../../assets/js/main.js"></script>
</body>
</html>
