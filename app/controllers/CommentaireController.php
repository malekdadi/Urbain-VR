<?php
require_once '../app/models/Commentaire.php';

class CommentaireController {

    // Afficher la liste des commentaires
    public function index() {
        $commentaireModel = new Commentaire();
        $commentaires = $commentaireModel->getAll();
        require '../app/views/commentaire/index.php';
    }

    // Afficher le formulaire d'ajout d'un commentaire
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $commentaire = $_POST['commentaire'] ?? '';

            // Créer le commentaire
            $commentaireModel = new Commentaire();
            $commentaireModel->create($nom, $email, $commentaire);

            // Rediriger vers la liste des commentaires
            header('Location: index.php?action=commentaire_index');
            exit;
        }

        require '../app/views/commentaire/add.php';
    }

    // Afficher le formulaire d'édition d'un commentaire
    public function edit($id_com) {
        $commentaireModel = new Commentaire();
        $commentaire = $commentaireModel->getById($id_com);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $commentaireText = $_POST['commentaire'] ?? '';

            $commentaireModel->update($id_com, $nom, $email, $commentaireText);

            // Rediriger vers la liste des commentaires
            header('Location: index.php?action=commentaire_index');
            exit;
        }

        require '../app/views/commentaire/edit.php';
    }

    // Supprimer un commentaire
    public function delete($id_com) {
        $commentaireModel = new Commentaire();
        $commentaireModel->delete($id_com);

        // Rediriger vers la liste des commentaires
        header('Location: index.php?action=commentaire_index');
        exit;
    }
}
