<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Modifier l'utilisateur</title>

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
  <h2>Modifier l'utilisateur</h2>

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

  // Traitement du formulaire
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email = $_POST['email'];
      $role = $_POST['role'];

      $usermodel->updateUser($id_user, $nom, $prenom, $email, $role);
      echo "<div class='alert alert-success'>Utilisateur mis à jour avec succès.</div>";
      // Tu peux aussi rediriger : header('Location: ../../index.php?action=users');
  }
  ?>

  <form method="post" class="bg-light p-4 rounded shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Prénom</label>
      <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($user['prenom']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Rôle</label>
      <select name="role" class="form-select" required>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
        <!-- Ajoute d'autres rôles si besoin -->
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    <a href="../../index.php?action=users" class="btn btn-secondary">Annuler</a>
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
