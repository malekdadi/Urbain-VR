<?php
require_once(__DIR__ . '/../models/Commentaire.php');

class CommentaireController {

    public function index() {
        $commentaireModel = new Commentaire();
        $commentaires = $commentaireModel->getAllCommentaires();
        require_once(__DIR__ . '/../views/commentaire/index.php');
    }

    public function create($reclamation_id) {
        // Vérifie si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère les données du formulaire
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
                echo "Le commentaire ne peut pas être vide.";
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
                echo "Le commentaire ne peut pas être vide.";
            }
        }
}
