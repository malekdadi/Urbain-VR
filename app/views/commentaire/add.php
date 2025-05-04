<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Commentaire</title>
    <a href="http://localhost/reclamations_project_final/public/index.php?action=commentaire_index" class="btn-trii">
    💬 Affiche un commentaire
</a>
<!-- Bouton "Retour" sous le bouton "Afficher Commentaire" -->
<a href="http://localhost/reclamations_project_final/public/" class="btn-return">Retour</a>

    <style>
      /* Style du bouton "Retour" avec couleur verte */
.btn-return {
    display: inline-block;
    background-color: #388e3c; /* Couleur verte pour le bouton retour */
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-size: 1.1rem;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s ease, box-shadow 0.3s ease;
    font-weight: 600;
    position: fixed; /* Fixe le bouton */
    right: 20px;
    bottom: 20px; /* Placer le bouton retour sous le bouton "Afficher Commentaire" */
}

/* Changement de couleur au survol */
.btn-return:hover {
    background-color: #2e7d32; /* Vert plus foncé au survol */
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
}

/* Effet focus */
.btn-return:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(46, 125, 50, 0.7);
}

      
      /* Style du lien transformé en bouton */
.btn-trii {
    display: inline-block;
    background-color: #388e3c; /* Couleur de fond verte */
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-size: 1.1rem;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s ease;
    font-weight: 600;
    position: fixed; /* Fixe le bouton */
    left: 20px; /* Décale le bouton à gauche de la page */
    bottom: 20px; /* Décale le bouton vers le bas */
}

/* Changement de couleur au survol */
.btn-trii:hover {
    background-color: #2e7d32;
    transform: scale(1.05); /* Légère augmentation de la taille */
}

/* Effet focus */
.btn-trii:focus {
    outline: none; /* Supprimer l'effet de bordure par défaut */
    box-shadow: 0 0 8px rgba(46, 125, 50, 0.5); /* Ombre au focus */
}

        input, textarea {
            display: block;
            width: 300px;
            margin-bottom: 10px;
            padding: 8px;
        }

        .error {
            border: 1px solid red;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

<h1><span class="accent">a</span>jouter <span class="accent">c</span>ommentaire</h1>

<form id="commentaireForm" method="POST">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom">
    <div id="nomError" class="error-message"></div>

    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    <div id="emailError" class="error-message"></div>

    <label for="commentaire">Commentaire</label>
    <textarea id="commentaire" name="commentaire" rows="4"></textarea>
    <div id="commentaireError" class="error-message"></div>

    <button type="submit">Ajouter</button>
</form>

<script>
document.getElementById('commentaireForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêche l'envoi automatique

    // Reset erreurs
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));

    let isValid = true;

    const nom = document.getElementById('nom').value.trim();
    const email = document.getElementById('email').value.trim();
    const commentaire = document.getElementById('commentaire').value.trim();

    // Validation du nom
    if (nom === '') {
        document.getElementById('nomError').textContent = 'Le nom est requis.';
        document.getElementById('nom').classList.add('error');
        isValid = false;
    }

    // Validation de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '') {
        document.getElementById('emailError').textContent = 'L\'email est requis.';
        document.getElementById('email').classList.add('error');
        isValid = false;
    } else if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Email invalide.';
        document.getElementById('email').classList.add('error');
        isValid = false;
    }

    // Validation du commentaire
    if (commentaire === '') {
        document.getElementById('commentaireError').textContent = 'Le commentaire est requis.';
        document.getElementById('commentaire').classList.add('error');
        isValid = false;
    } else if (commentaire.length < 10) {
        document.getElementById('commentaireError').textContent = 'Le commentaire doit contenir au moins 10 caractères.';
        document.getElementById('commentaire').classList.add('error');
        isValid = false;
    }

    // Si valide, soumettre
    if (isValid) {
        this.submit();
    }
});
</script>

</body>
</html>

<style>
    
   /* Reset de base */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Corps */
body {
  font-family: 'Poppins', Arial, sans-serif;
  background: linear-gradient(135deg, #e0f2f1, #f1f8e9);
  background-attachment: fixed;
  min-height: 100vh;
  color: #333;
  padding: 50px;
  display: flex;
  justify-content: center;
  align-items: center; /* Centrer verticalement */
  text-align: center;
  flex-direction: column; /* Alignement vertical */
}

/* Titre */
h1 {
  font-size: 2.8rem;
  margin-bottom: 25px;
  color: #2e7d32;
  text-transform: lowercase; /* Met tout en minuscule par défaut */
  letter-spacing: 1px;
  font-weight: 600;
  animation: fadeIn 2s ease-in-out;
}

/* Sélectionne les lettres A et C (majuscules et minuscules) */
h1::first-letter,
h1 span.accent {
  text-transform: uppercase !important;
}
/* Formulaire */
form {
  background: #ffffff;
  padding: 30px;
  max-width: 600px;
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 128, 0, 0.2);
  transition: transform 0.3s ease;
  animation: fadeInUp 1.5s ease-in-out;
  margin-bottom: 40px; /* Ajout de marge entre le formulaire et le tableau */
}

form:hover {
  transform: scale(1.03);
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: 600;
  color: #388e3c;
  font-size: 1.1rem;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 12px 15px;
  margin-bottom: 20px;
  border: 2px solid #c8e6c9;
  border-radius: 8px;
  font-size: 1rem;
  transition: border-color 0.3s, box-shadow 0.3s;
  background: #f9f9f9;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
  border-color: #388e3c;
  box-shadow: 0 0 8px rgba(46, 125, 50, 0.4);
}

textarea {
  resize: vertical;
  min-height: 120px;
}

/* Bouton */
button {
  background: linear-gradient(45deg, #43a047, #2e7d32);
  border: none;
  color: white;
  padding: 14px 28px;
  font-size: 1.1rem;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  transition: background 0.4s, transform 0.3s;
  opacity: 0.9;
}

button:hover {
  background: linear-gradient(45deg, #2e7d32, #43a047);
  transform: translateY(-2px);
  opacity: 1; /* Retour à l'opacité normale */
}

/* Tableau des commentaires */
table {
  width: 100%;
  margin-top: 40px;
  border-collapse: collapse;
  background: #ffffff;
  box-shadow: 0 4px 10px rgba(0, 128, 0, 0.1);
  border-radius: 12px;
  overflow: hidden;
  animation: fadeInUp 1.5s ease-in-out;
}

th, td {
  padding: 16px 20px;
  border-bottom: 1px solid #c8e6c9;
}

th {
  background: #66bb6a;
  color: white;
  font-weight: bold;
  text-align: left;
}

tr:nth-child(even) {
  background: #f1f8e9;
}

tr:hover {
  background: #c5e1a5;
}

/* Liens */
a {
  color: #2e7d32;
  font-weight: 500;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Messages d'erreur */
.error {
  border-color: #e53935 !important;
}

.error-message {
  color: #e53935;
  font-size: 0.9em;
  margin-top: -10px;
  margin-bottom: 10px;
  display: block;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive */
@media (max-width: 768px) {
  form, table {
    width: 100%;
    padding: 20px;
  }

  h1 {
    font-size: 2.2rem;
  }

  input, textarea {
    font-size: 1rem;
  }
}

 <style>
  </body>
</html>
