<?php
// Inclure la connexion à la base de données
require_once '../../config/database.php';
require_once '../../models/Pack.php';

$packModel = new Pack();
$packs = $packModel->getAllPacks();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste des Packs</title>

  <!-- Bootstrap CSS -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include '../../templates/header-views.php'; ?>
<?php include '../../templates/navbar-views.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4">Liste des Packs</h2>

  <?php if (!empty($packs)) : ?>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID Pack</th>
          <th>ID Utilisateur</th>
          <th>ID Abonnement</th>
          <th>Prix</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($packs as $pack) : ?>
          <tr>
            <td><?php echo htmlspecialchars($pack['id_pack']); ?></td>
            <td><?php echo htmlspecialchars($pack['id_user']); ?></td>
            <td><?php echo htmlspecialchars($pack['id_abon']); ?></td>
            <td><?php echo htmlspecialchars($pack['prix']); ?> TND</td>
            <td>
            <a href="update-pack.php?id=<?php echo $pack['id_pack']; ?>" class="btn btn-primary btn-sm">Modifier</a>

              <a href="delete-pack.php?id=<?php echo $pack['id_pack']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce pack ?');">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else : ?>
    <div class="alert alert-info">Aucun pack trouvé.</div>
  <?php endif; ?>

  <a href="add-pack.php" class="btn btn-success">Ajouter un Pack</a>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Bootstrap JS -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
