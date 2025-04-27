<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ajouter un utilisateur</title>

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
  <h2>Ajouter un nouvel utilisateur</h2>

  <?php
  require_once '../../config/database.php';
  require_once '../../models/User.php';

  $errors = [];
  $success = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = trim($_POST['nom']);
      $prenom = trim($_POST['prenom']);
      $email = trim($_POST['email']);
      $mdp = trim($_POST['mdp']);
      $role = $_POST['role'];

      if (empty($nom)) $errors[] = "Le nom est requis.";
      if (empty($prenom)) $errors[] = "Le prénom est requis.";
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
      if (strlen($mdp) < 6) $errors[] = "Mot de passe trop court (6 caractères min).";
      if (empty($role)) $errors[] = "Le rôle est requis.";

      if (empty($errors)) {
          $db = new Database();
          $conn = $db->getConnection();

          $userModel = new User($conn);
          //$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

          $userModel->addUser($nom, $prenom, $email, $mdp, $role);
          $success = true;
      }
  }
  ?>

  <div class="bg-light p-4 rounded shadow-sm">
    <form method="post" id="addUserForm">
      <div class="mb-3">
        <label for="nom" class="form-label"><strong>Nom</strong></label>
        <input type="text" class="form-control" id="nom" name="nom" required>
      </div>

      <div class="mb-3">
        <label for="prenom" class="form-label"><strong>Prénom</strong></label>
        <input type="text" class="form-control" id="prenom" name="prenom" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label"><strong>Email</strong></label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label"><strong>Rôle</strong></label>
        <select class="form-control" id="role" name="role" required>
        <option value="visiteur">Visiteur</option>
        <option value="contributeur">Contributeur</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="mdp" class="form-label"><strong>Mot de passe</strong></label>
        <input type="password" class="form-control" id="mdp" name="mdp" required>
      </div>

      <button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>
      <a href="../../index.php?action=users" class="btn btn-secondary">Annuler</a>
    </form>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger mt-3">
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php elseif ($success): ?>
    <div class="alert alert-success mt-3">Utilisateur ajouté avec succès !</div>
  <?php endif; ?>
</div>

<?php include '../../templates/footer-views.php'; ?>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="../../assets/js/main-js.js"></script>

<!-- Script de validation en temps réel -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addUserForm");
    const nomInput = document.getElementById("nom");
    const prenomInput = document.getElementById("prenom");
    const emailInput = document.getElementById("email");
    const mdpInput = document.getElementById("mdp");

    function showFeedback(input, message, isValid) {
        let feedback = input.nextElementSibling;
        if (!feedback || !feedback.classList.contains("form-text")) {
            feedback = document.createElement("div");
            feedback.className = "form-text mt-1";
            input.parentNode.appendChild(feedback);
        }
        feedback.textContent = message;
        feedback.style.color = isValid ? "green" : "red";
        input.classList.remove("is-invalid", "is-valid");
        input.classList.add(isValid ? "is-valid" : "is-invalid");
    }

    function validateNomPrenom(input) {
        const value = input.value.trim();
        const isValid = value.length >= 3 && /^[A-Z]/.test(value);
        if (!isValid) {
            showFeedback(input, "Doit contenir au moins 3 caractères et commencer par une majuscule.", false);
        } else {
            showFeedback(input, "Champ valide !", true);
        }
        return isValid;
    }

    function validateEmail(input) {
        const value = input.value.trim();
        const isValid = value.includes("@");
        if (!isValid) {
            showFeedback(input, "Adresse email invalide (manque '@').", false);
        } else {
            showFeedback(input, "Email valide !", true);
        }
        return isValid;
    }

    function validatePassword(input) {
        const value = input.value;
        const isValid = value.length > 6;
        if (!isValid) {
            showFeedback(input, "Mot de passe trop court (minimum 7 caractères).", false);
        } else {
            showFeedback(input, "Mot de passe valide !", true);
        }
        return isValid;
    }

    nomInput.addEventListener("input", () => validateNomPrenom(nomInput));
    prenomInput.addEventListener("input", () => validateNomPrenom(prenomInput));
    emailInput.addEventListener("input", () => validateEmail(emailInput));
    mdpInput.addEventListener("input", () => validatePassword(mdpInput));

    form.addEventListener("submit", function (e) {
        const isNomValid = validateNomPrenom(nomInput);
        const isPrenomValid = validateNomPrenom(prenomInput);
        const isEmailValid = validateEmail(emailInput);
        const isMdpValid = validatePassword(mdpInput);

        if (!(isNomValid && isPrenomValid && isEmailValid && isMdpValid)) {
            e.preventDefault();
        }
    });
});
</script>

</body>
</html>