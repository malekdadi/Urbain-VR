<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Commentaires</title>
</head>

<body>
    
    <h1>Liste des Commentaires</h1>
    <a href="index.php?action=commentaire_add" class="btn-ajouter">  retour  commentaire</a>

    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentaires as $commentaire): ?>
                <tr>
                    <td><?= $commentaire['id_com'] ?></td>
                    <td><?= $commentaire['nom'] ?></td>
                    <td><?= $commentaire['email'] ?></td>
                    <td><?= $commentaire['commentaire'] ?></td>
                    <td><?= $commentaire['date_creation'] ?></td>
                    <td>
                        <a href="index.php?action=commentaire_edit&id=<?= $commentaire['id_com'] ?>">Modifier</a> | 
                        <a href="index.php?action=commentaire_delete&id=<?= $commentaire['id_com'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <style>
 /* Reset basique */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Corps de page */
body {
  font-family: 'Poppins', sans-serif;
  background: #e8f5e9; /* Fond vert pâle */
  color: #333;
  padding: 20px;
  line-height: 1.6;
  font-size: 16px;
}

/* Titres */
h1 {
  margin-bottom: 20px;
  font-size: 2.2em;
  color: #388e3c; /* Vert moyen */
  text-align: center;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: capitalize;
  position: relative;
}

h1::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: #2c6e1f; /* Légèrement plus foncé pour l'accent */
  border-radius: 2px;
}

/* Bouton ajouter premium */
a.btn-ajouter {
  display: inline-block;
  padding: 12px 24px;
  font-size: 1.2rem;
  font-weight: 600;
  text-decoration: none;
  background: linear-gradient(45deg, #388e3c, #2c6e1f); /* Vert moyen */
  color: white;
  border-radius: 8px;
  transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

a.btn-ajouter:hover {
  background: linear-gradient(45deg, #2c6e1f, #388e3c); /* Changement de couleur au survol */
  transform: translateY(-4px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

a.btn-ajouter:focus {
  outline: none;
  box-shadow: 0 0 8px rgba(46, 125, 50, 0.6);
}

/* Tableau des commentaires */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: #fff;
  box-shadow: 0 4px 16px rgba(0,0,0,0.1);
  border-radius: 8px;
  overflow: hidden;
}

th, td {
  padding: 15px 20px;
  border: 1px solid #c8e6c9; /* Bordures plus douces mais visibles */
  font-size: 1.1rem;
}

th {
  background-color: #388e3c; /* Vert moyen pour les titres de colonnes */
  color: #fff;
  text-align: left;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
}

td {
  background-color: #f9f9f9;
}

tr:nth-child(even) td {
  background-color: #e8f5e9; /* Vert pâle pour les lignes paires */
}

tr:hover {
  background-color: #c8e6c9; /* Vert doux au survol */
  cursor: pointer;
  transform: scale(1.02);
  transition: transform 0.2s ease;
}

td button {
  background: #388e3c; /* Vert moyen pour les boutons */
  color: white;
  border: none;
  padding: 8px 15px;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s ease;
}

td button:hover {
  background: #2c6e1f; /* Vert légèrement plus foncé pour le survol */
  transform: translateY(-2px);
}

td button:focus {
  outline: none;
  box-shadow: 0 0 6px rgba(46, 125, 50, 0.6);
}

/* Erreur dans les champs (en rouge) */
.error {
  border-color: #dc3545 !important;
}

.error-message {
  color: #dc3545;
  font-size: 0.9em;
  margin-top: -10px;
  margin-bottom: 10px;
  display: block;
  font-weight: 600;
}

/* Liens d’action */
a {
  color: #388e3c; /* Vert moyen pour les liens */
  text-decoration: none;
  margin-right: 15px;
  font-weight: 600;
}

a:hover {
  text-decoration: underline;
}

/* Animation de fade-in pour les éléments de page */
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

.animated {
  animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
  body {
    padding: 10px;
  }

  h1 {
    font-size: 1.6em;
  }

  a.btn-ajouter {
    padding: 10px 20px;
    font-size: 1rem;
  }

  table {
    margin-top: 15px;
  }

  th, td {
    padding: 10px;
  }
}


<style>
</body>
</html>
