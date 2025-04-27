<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Détails de l'utilisateur</title>

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
  <h2>Détails de l'utilisateur</h2>

  <?php
  // Vérifier si l'ID est passé dans l'URL
  if (isset($_GET['id']) && !empty($_GET['id'])) {
      $id_user = $_GET['id'];
  } else {
      echo "L'ID de l'utilisateur est manquant ou invalide.";
      exit; // Stoppe l'exécution du script si l'ID est absent
  }

  // Utiliser $id_user pour récupérer les données de l'utilisateur dans la base de données
  require_once '../../models/User.php'; // Inclure le modèle pour récupérer les données de l'utilisateur
  $usermodel = new User();
  $user = $usermodel->getUserById($id_user); // Appeler la méthode pour récupérer l'utilisateur

  // Vérifier si l'utilisateur a été trouvé
  if ($user):
  ?>

  <div class="bg-light p-4 rounded shadow-sm">
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

    <div class="mb-3">
      <label class="form-label"><strong>Rôle :</strong></label>
      <p><?= htmlspecialchars($user['role']) ?></p>
    </div>

    <a href="../../index.php?action=users" class="btn btn-success mt-2">Retour à la liste</a>
  </div>

  <?php else: ?>
    <div class="alert alert-danger mt-3">
        Utilisateur introuvable.
        <a href="../../index.php?action=users" class="btn btn-success mt-2">Retour à la liste des utilisateurs</a>
    </div>
  <?php endif; ?>

</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="../../assets/js/main.js"></script>
</body>
</html>

















