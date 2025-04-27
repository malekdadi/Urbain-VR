<?php
// Vérification des données
$viewPath = __DIR__ . '/../views/reclamation/update.php';

if (!isset($reclamation) || !is_array($reclamation)) {
    die("Erreur : Données de réclamation manquantes");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Réclamation #<?= htmlspecialchars($reclamation['id'] ?? '') ?></title>
    <style>
    body { 
        font-family: Arial, sans-serif; 
        margin: 20px; 
        background-color: #f0fdf4; /* fond vert très clair */
    }

    .form-group { 
        margin-bottom: 20px; 
    }

    label { 
        display: block; 
        margin-bottom: 6px; 
        font-weight: bold;
        color: #065f46; /* vert foncé */
    }

    input, textarea { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #34d399; /* vert clair */
        border-radius: 8px;
        background-color: #ffffff;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus, textarea:focus {
        border-color: #10b981; /* vert plus vif */
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
        outline: none;
    }

    button { 
        padding: 10px 20px; 
        background: #10b981; /* vert bouton */
        color: white; 
        border: none; 
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background: #059669; /* vert foncé au survol */
    }
</style>

</head>
<body>
    <h2>Modifier Réclamation </h2>
    
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id'] ?? '') ?>">
        
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($reclamation['nom'] ?? '') ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($reclamation['email'] ?? '') ?>" required>
        </div>
        
        <div class="form-group">
            <label>Message :</label>
            <textarea name="message" required><?= htmlspecialchars($reclamation['message'] ?? '') ?></textarea>
        </div>
        
        <button type="submit">Mettre à jour</button>
    </form>
    
    <p><a href="index.php?action=create">← Retour à la liste</a></p>
    <script src="/reclamations_project_final/public/js/form-validation.js"></script>
</body>
</html>