<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Commentaire</title>
</head>
<body>
    <h1>Modifier Commentaire</h1>
    <form method="POST">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $commentaire['nom'] ?>" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $commentaire['email'] ?>" required><br>

        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" id="commentaire" required><?= $commentaire['commentaire'] ?></textarea><br>

        <button type="submit">Mettre à jour</button>
    </form>
    <style>
/* Reset basique */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Corps de la page */
body {
  font-family: 'Poppins', Arial, sans-serif;
  background: linear-gradient(135deg, #b2dfdb, #c8e6c9); /* Fond dégradé */
  min-height: 100vh;
  padding: 50px 0;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  color: #333;
  text-align: center;
}

/* Titre Modifier un Commentaire */
/* Titres */
/* Titres */
h1 {
  font-size: 2.5rem;
  margin-bottom: 30px;
  color: #388e3c; /* Vert foncé */
  text-transform: capitalize; /* Mettre la première lettre en majuscule */
  font-weight: 600;
  letter-spacing: 1.5px;
  animation: fadeInUp 1s ease-in-out;
}



/* Formulaire */
form {
  background: #ffffff;
  padding: 30px;
  width: 100%;
  max-width: 700px;
  border-radius: 12px;
  box-shadow: 0 12px 24px rgba(0, 128, 0, 0.1);
  transition: transform 0.3s ease;
  animation: fadeInUp 1.5s ease-in-out;
}

form:hover {
  transform: scale(1.03);
}

/* Champs du formulaire */
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
  padding: 15px;
  margin-bottom: 20px;
  border: 2px solid #c8e6c9;
  border-radius: 8px;
  font-size: 1.1rem;
  background: #f9f9f9;
  transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
  border-color: #2e7d32;
  box-shadow: 0 0 8px rgba(46, 125, 50, 0.3);
}

textarea {
  resize: vertical;
  min-height: 150px;
}

/* Bouton */
button {
  background: linear-gradient(45deg, #388e3c, #2e7d32);
  border: none;
  color: white;
  padding: 14px 28px;
  font-size: 1.1rem;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  transition: background 0.3s, transform 0.3s ease;
}

button:hover {
  background: linear-gradient(45deg, #2e7d32, #388e3c);
  transform: translateY(-2px);
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

/* Animation fade-in */
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
    font-size: 2rem;
  }

  input, textarea {
    font-size: 1rem;
  }
}

<style>
</body>
</html>
