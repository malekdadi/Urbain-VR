<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(strtolower($_POST['email']));
    $mdp = trim($_POST['mdp']);

    $db = new Database();
    $conn = $db->getConnection();
    $userModel = new User($conn);

    $user = $userModel->getUserByEmail($email);

    if ($user) {
        $hashStocke = $user['mdp'];
        
        if (password_verify($mdp, $hashStocke)) {
            $_SESSION['user'] = [
                'id_user' => $user['id_user'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            header("Location: ../views/backoffice/dashboard.php");
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>
<?php include '../templates/header-login.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Connexion</h2>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" class="bg-light p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="email">Email :</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="mdp">Mot de passe :</label>
      <input type="password" class="form-control" id="mdp" name="mdp" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
  </form>
 <!-- Bouton pour s'inscrire -->
  <center>
 <div class="mt-3">
    <p>Pas encore de compte ?</p>
    <a href="ajouter.php" class="btn btn-outline-secondary">Ajouter un utilisateur</a>
  </div>
  </center>
  <?php include '../templates/footer-auth.php'; ?>
</body>
</html>

