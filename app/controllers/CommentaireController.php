<?php
require_once(__DIR__ . '/../models/Commentaire.php');

class CommentaireController {

    public function index()
    {
        require_once(__DIR__ . '/../models/Commentaire.php');
        $commentaireModel = new Commentaire();
        require_once(__DIR__ . '/../views/commentaire/index.php');
    }
    
  /*  public function create($reclamation_id) {
        // Récupérer la réclamation associée à cet ID
        $reclamationModel = new Reclamation();
        $reclamation = $reclamationModel->getReclamationById($reclamation_id);

        // Si la réclamation existe, afficher le formulaire
        if ($reclamation) {
            require_once(__DIR__ . '/../views/commentaire/create.php');
        } else {
            // Si la réclamation n'existe pas, afficher un message d'erreur
            echo "Réclamation non trouvée.";
        }
    }*/

    // Enregistrer le commentaire dans la base de données
    public function store($reclamation_id, $message) {
        // Créer un modèle de commentaire et enregistrer
        $commentaireModel = new Commentaire();
        $commentaireModel->createCommentaire($reclamation_id, $message);

        // Rediriger vers la page de la réclamation après l'ajout du commentaire
        header("Location: index.php?action=show&id=" . $reclamation_id);
        exit();
    }

    public function update($id) {
        $commentaireModel = new Commentaire();
        $commentaire = $commentaireModel->getCommentaireById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reclamation_id = $_POST['reclamation_id'];
            $commentaires = $_POST['commentaires'];
            $commentaireModel->updateCommentaire($id, $reclamation_id, $commentaires);
            header("Location: index.php?action=commentaire_index");
        }
        require_once(__DIR__ . '/../views/commentaire/update.php');
    }
    

    public function delete($id) {
        $commentaireModel = new Commentaire();
        $commentaireModel->deleteCommentaire($id);
        header("Location: index.php?action=commentaire_index");
    }
 

        // Fonction pour ajouter un commentaire
        public function create($reclamation_id) {
            // Vérifie si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupère le texte du commentaire
                $commentaire = $_POST['commentaire'];
    
                // Vérifie que le commentaire n'est pas vide
                if (!empty($commentaire)) {
                    // Crée une instance du modèle Commentaire
                    require_once(__DIR__ . '/../models/Commentaire.php');
                    $commentaireModel = new Commentaire();
    
                    // Appelle la méthode pour ajouter le commentaire dans la base de données
                    $commentaireModel->createCommentaire($reclamation_id, $commentaire);
    
                    // Redirige l'utilisateur vers la page des réclamations après l'ajout du commentaire
                    header("Location: index.php?action=index");
                    exit();
                } else {
                    echo "Création du commentaire pour la réclamation ID: $reclamation_id";
                }
            }
    
            // Affiche la vue pour ajouter un commentaire
            require_once(__DIR__ . '/../views/commentaire/create.php');
        }
 

}

    
    
   
