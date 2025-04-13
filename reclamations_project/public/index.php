<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réclamations</title>
    <link rel="stylesheet" href="style.css"> <!-- ✅ Chemin relatif à public/ -->
</head>
<body>
    <!-- ton contenu ici -->
</body>
</html>

<?php

require_once(__DIR__ . '/../app/controllers/ReclamationController.php');
require_once(__DIR__ . '/../app/controllers/CommentaireController.php');

// Vérifier si l'action existe dans l'URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    echo "Action: " . $action . "<br>";  // Débogage de l'action
} else {
    $action = 'index';  // Action par défaut
    echo "Action par défaut : index<br>";  // Débogage de l'action par défaut
}

// Pour la gestion des réclamations
$reclamationController = new ReclamationController();
if ($action === 'index') {
    echo "Exécution de l'action 'index' pour ReclamationController<br>";
    $reclamationController->index();
} elseif ($action === 'create') {
    echo "Exécution de l'action 'create' pour ReclamationController<br>";
    $reclamationController->create();
} elseif ($action === 'update' && isset($_GET['id'])) {
    echo "Exécution de l'action 'update' pour ReclamationController avec ID: " . $_GET['id'] . "<br>";
    $reclamationController->update($_GET['id']);
} elseif ($action === 'delete' && isset($_GET['id'])) {
    echo "Exécution de l'action 'delete' pour ReclamationController avec ID: " . $_GET['id'] . "<br>";
    $reclamationController->delete($_GET['id']);
}

// Pour la gestion des commentaires

switch ($action) {
    case 'index':
        echo "Exécution de l'action 'index' pour CommentaireController<br>";
       // $commentaireController->index(); // Afficher la liste des commentaires
        break;

    case 'create':
        if (isset($_GET['reclamation_id'])) {
            echo "Exécution de l'action 'create' pour CommentaireController avec reclamation_id: " . $_GET['reclamation_id'] . "<br>";
            $commentaireController->create($_GET['reclamation_id']); // Ajouter un commentaire
        } else {
            echo "reclamation_id manquant pour create";
        }
        break;

    case 'update':
        if (isset($_GET['id'])) {
            echo "Exécution de l'action 'update' pour CommentaireController avec ID: " . $_GET['id'] . "<br>";
           // $commentaireController->update($_GET['id']); // Modifier un commentaire
        } else {
            echo "ID manquant pour update";
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            echo "Exécution de l'action 'delete' pour CommentaireController avec ID: " . $_GET['id'] . "<br>";
            $commentaireController->delete($_GET['id']); // Supprimer un commentaire
        } else {
            echo "ID manquant pour delete";
        }
        break;

    case 'add_commentaire':
        if (isset($_GET['reclamation_id'])) {
            echo "Exécution de l'action 'add_commentaire' pour CommentaireController avec reclamation_id: " . $_GET['reclamation_id'] . "<br>";
            $commentaireController->create($_GET['reclamation_id']);
        } else {
            echo "reclamation_id manquant pour add_commentaire";
        }
        break;

    default:
        echo "Action non reconnue ou paramètres manquants pour CommentaireController<br>";
        break;
}


?>
