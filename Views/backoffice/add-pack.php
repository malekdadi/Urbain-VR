<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ajouter un pack</title>

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
  <h2>Ajouter un nouveau pack</h2>

  <?php
  require_once '../../models/Pack.php';
  require_once '../../config/database.php'; // pour accéder à la base

  // Traitement de l'ajout d'un pack
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_user = trim($_POST['id_user']);
      $id_abon = trim($_POST['id_abon']);
      $prix = trim($_POST['prix']);

      $packmodel = new Pack();
      $result = $packmodel->addPack($id_user, $id_abon, $prix);

      if ($result) {
          echo "<div class='alert alert-success'>Pack ajouté avec succès.</div>";
          echo "<a href='../../index.php?action=packs' class='btn btn-success mt-2'>Retour à la liste des packs</a>";
          exit;
      } else {
          echo "<div class='alert alert-danger'>Une erreur est survenue lors de l'ajout.</div>";
      }
  }

  // Récupérer les id_user existants
  try {
      $pdo = config::getConnexion();
      $stmt = $pdo->query("SELECT id_user FROM user");
      $users = $stmt->fetchAll(PDO::FETCH_COLUMN);
  } catch (Exception $e) {
      echo "<div class='alert alert-danger'>Erreur lors du chargement des utilisateurs.</div>";
      $users = [];
  }
  ?>

  <div class="bg-light p-4 rounded shadow-sm">
    <form method="post" id="addPackForm">
      <div class="mb-3">
        <label for="id_user" class="form-label"><strong>ID Utilisateur</strong></label>
        <input type="number" class="form-control" id="id_user" name="id_user" required>
        <small id="id_user_error"></small>
      </div>

      <div class="mb-3">
        <label for="id_abon" class="form-label"><strong>ID Abonnement</strong></label>
        <input type="number" class="form-control" id="id_abon" name="id_abon" required>
        <small id="id_abon_error"></small>
      </div>

      <div class="mb-3">
        <label for="prix" class="form-label"><strong>Prix</strong></label>
        <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        <small id="prix_error"></small>
      </div>

      <button type="submit" class="btn btn-primary">Ajouter le pack</button>
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

<script>
// Tableau des ID utilisateurs existants en JS
const utilisateursExistants = <?php echo json_encode($users); ?>;

// Contrôle de saisie du formulaire
document.getElementById('addPackForm').addEventListener('submit', function(event) {
  let isValid = true;

  const idUserInput = document.getElementById('id_user');
  const prixInput = document.getElementById('prix');
  const idUserError = document.getElementById('id_user_error');
  const prixError = document.getElementById('prix_error');

  // Vérification de l'ID utilisateur
  if (!utilisateursExistants.includes(idUserInput.value.trim())) {
    idUserError.textContent = "❌ ID utilisateur introuvable.";
    idUserError.style.color = "red";
    isValid = false;
  } else {
    idUserError.textContent = "✔️ ID valide.";
    idUserError.style.color = "green";
  }

  // Vérification du prix
  const prixValide = [0, 49, 150];
  if (!prixValide.includes(parseFloat(prixInput.value.trim()))) {
    prixError.textContent = "❌ Prix doit être 0, 49 ou 150.";
    prixError.style.color = "red";
    isValid = false;
  } else {
    prixError.textContent = "✔️ Prix valide.";
    prixError.style.color = "green";
  }

  if (!isValid) {
    event.preventDefault(); // Stopper l'envoi du formulaire
  }
});
</script>
</body>
</html>
