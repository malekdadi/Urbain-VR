<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réclamations</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="/reclamations_project_final/public/js/form-validation.js"></script>
    <style>
        .error { border: 1px solid red; }
        .error-message { color: red; font-size: 0.8em; }
        .form-group { margin-bottom: 15px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<script src="/reclamations_project_final/public/js/form-validation.js"></script>
<link rel="stylesheet" href="/public/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<body>
<h2 class="titre-vert">Ajouter une Réclamation</h2>

    <?php
$currentOrder = $_GET['order'] ?? 'ASC';
$toggleOrder = ($currentOrder === 'ASC') ? 'DESC' : 'ASC';
?>

<a href="index.php?action=index&order=<?= $toggleOrder ?>" class="btn-tri">
    📋 Afficher le tableau </a>
</a>
<style>
.btn-tri {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    padding: 10px 20px;
    margin: 10px 0;
    text-decoration: none;
    border-radius: 25px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-tri:hover {
    background-color: #388e3c;
    transform: scale(1.05);
}
</style>

<form method="POST" id="reclamationForm" class="form-container">
  <div class="form-group">
    <input type="text" id="nom" name="nom" placeholder="Nom" class="input-field">
    <span class="error-message" id="nomError"></span>
  </div>
  <div class="form-group">
    <input type="email" id="email" name="email" placeholder="Email" class="input-field">
    <span class="error-message" id="emailError"></span>
  </div>
  <div class="form-group">
    <textarea id="message" name="message" placeholder="Message" class="input-field"></textarea>
    <span class="error-message" id="messageError"></span>
  </div>
  <button type="submit" class="submit-btn">Ajouter</button>
</form>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface avec Logo en Haut</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            justify-content: flex-end; /* tout aligné à droite */
            align-items: center;
            background-color: transparent; /* plus de fond vert */
            padding: 10px 20px;
            height: 80px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .texte {
            font-size: 28px;
            font-weight: bold;
            color: #2e7d32; /* Vert foncé – tu peux changer ça aussi si tu veux */
            margin-right: 15px;
        }

        .logo {
    width: 200px; /* kbbar el image */
    height: auto;
    position: absolute;
    right: 50px;  /* b3edna 50px ala limine */
    top: 10px;
}




        .content {
            padding-top: 100px; /* Pour ne pas cacher le contenu sous le header */
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="texte">URBA-VR</div>
        <img src="assets/img/logo.jpg" alt="Logo" width="100">

        
    </div>
</body>
</html>


<style>


.logo {
  height: 60px;
  object-fit: contain;
}

  /* Conteneur centré */
  .form-container {
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fafafa;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .form-group {
    margin-bottom: 16px;
  }

  /* Champs de saisie */
  .input-field {
    width: 100%;
    padding: 10px 12px;
    font-size: 15px;
    border: 1px solid #8bc34a; /* vert tendre */
    border-radius: 4px;
    background-color: #f7fdf4;
    transition: border-color 0.2s, background-color 0.2s;
  }
  .input-field:focus {
    outline: none;
    border-color: #4caf50; /* vert normal */
    background-color: #efffed;
  }

  /* Message d’erreur (caché par défaut) */
  .error-message {
    display: block;
    margin-top: 4px;
    font-size: 13px;
    color: #d32f2f;
  }

  /* Bouton principal */
  .submit-btn {
    width: 100%;
    padding: 12px 0;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    background-color: #4caf50; /* vert normal */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.1s;
  }
  .submit-btn:hover {
    background-color: #43a047; /* vert sombre */
  }
  .submit-btn:active {
    transform: translateY(1px);
  }
  .titre-vert {
  color: #388e3c;        /* Vert foncé */
  font-size: 2em;        /* Ajuste la taille si besoin */
  text-align: center;    /* Centré */
  margin-bottom: 20px;   /* Espace sous le titre */
  font-weight: bold;     /* En gras */
}

</style>

    <script>
    document.getElementById('reclamationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Réinitialiser les erreurs
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));
        
        let isValid = true;
        const nom = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        // Validation du nom
        if (nom === '') {
            document.getElementById('nomError').textContent = 'Le nom est requis';
            document.getElementById('nom').classList.add('error');
            isValid = false;
        }
        
        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').textContent = 'Email invalide';
            document.getElementById('email').classList.add('error');
            isValid = false;
        }
        
        // Validation du message
        if (message === '') {
            document.getElementById('messageError').textContent = 'Le message est requis';
            document.getElementById('message').classList.add('error');
            isValid = false;
        } else if (message.length < 10) {
            document.getElementById('messageError').textContent = 'Le message doit contenir au moins 10 caractères';
            document.getElementById('message').classList.add('error');
            isValid = false;
        }
        
        if (isValid) {
            this.submit();
        }
    });
    </script>
</body>
</html>
