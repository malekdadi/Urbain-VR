<?php
require_once(__DIR__ . '/../models/Reclamation.php');

class ReclamationController {

    public function index() {
        $reclamationModel = new Reclamation();
        $reclamations = $reclamationModel->getAllReclamations();
        require_once(__DIR__ . '/../views/reclamation/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $reclamationModel = new Reclamation();
            $reclamationModel->createReclamation($nom, $email, $message);
            header("Location: index.php");
        }
        require_once(__DIR__ . '/../views/reclamation/create.php');
    }

    public function update($id) {
        $reclamationModel = new Reclamation();
        $reclamation = $reclamationModel->getReclamationById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $reclamationModel->updateReclamation($id, $nom, $email, $message);
            header("Location: index.php");
        }
        require_once(__DIR__ . '/../views/reclamation/update.php');
    }

    public function delete($id) {
        $reclamationModel = new Reclamation();
        $reclamationModel->deleteReclamation($id);
        header("Location: index.php");
    }
}
