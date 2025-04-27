<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Supprimer l'utilisateur</title>

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
<?php include '../../templates/header-user.php'; ?>
<?php include '../../templates/navbar-views.php'; ?>

<div class="container mt-4">
  <h2>Supprimer l'utilisateur</h2>

  <?php
  require_once '../../models/User.php';
  $usermodel = new User();

  if (isset($_GET['id']) && !empty($_GET['id'])) {
      $id_user = $_GET['id'];
      $user = $usermodel->getUserById($id_user);
  } else {
      echo "<div class='alert alert-danger'>ID utilisateur manquant.</div>";
      exit;
  }

  if (!$user) {
      echo "<div class='alert alert-danger'>Utilisateur introuvable.</div>";
      exit;
  }

  // Traitement de la suppression
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usermodel->deleteUser($id_user);
      echo "<div class='alert alert-success'>Utilisateur supprimé avec succès.</div>";
      echo "<a href='../../index.php?action=users' class='btn btn-success mt-2'>Retour à la liste des utilisateurs</a>";
      exit; // Terminer l'exécution après suppression
  }
  ?>

  <div class="bg-light p-4 rounded shadow-sm">
    <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>

    <div class="mb-3">
      <label class="form-label"><strong>ID :</strong></label>
      <p><?= htmlspecialchars($user['id_user']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>Nom :</strong></label>
      <p><?= htmlspecialchars($user['nom']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>Prénom :</strong></label>
      <p><?= htmlspecialchars($user['prenom']) ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><strong>Email :</strong></label>
      <p><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <form method="post">
      <button type="submit" class="btn btn-danger">Supprimer cet utilisateur</button>
      <a href="../../index.php?action=users" class="btn btn-secondary">Annuler</a>
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
