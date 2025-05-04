<?php
require_once '../app/controllers/ReclamationController.php';
require_once '../app/controllers/CommentaireController.php'; // Ajoute ce require

define('VIEWS_PATH', __DIR__ . '/../app/views/');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$action = $_GET['action'] ?? 'create';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Gérer les actions de Commentaire
if (strpos($action, 'commentaire_') === 0) {
    $commentaireController = new CommentaireController();
    if ($action === 'commentaire_index') {
        $commentaireController->index();
    } elseif ($action === 'commentaire_add') {
        $commentaireController->add();
    } elseif ($action === 'commentaire_edit' && $id) {
        $commentaireController->edit($id);
    } elseif ($action === 'commentaire_delete' && $id) {
        $commentaireController->delete($id);
    } else {
        echo "Action Commentaire non trouvée.";
    }
}
// Gérer les actions de Réclamation
else {
    $reclamationController = new ReclamationController();
    if ($action === 'update' && $id) {
        $reclamationController->update($id);
    } elseif ($action === 'delete' && $id) {
        $reclamationController->delete($id);
    } elseif ($action === 'send_mail') {
        $reclamationController->sendMail($id);
    } elseif ($action === 'index') {
        $reclamationController->index();
    } elseif ($action === 'download_pdf') {
        $reclamationController->downloadPdf();
    } elseif ($action === 'download_excel') {
        $reclamationController->downloadExcel();
    } elseif ($action === 'stats') {
        $reclamationController->afficherStatistiquesMessages();
    }  elseif ($action === 'chercher') {  // Correction ici : on utilise $reclamationController
        $reclamationController->rechercher();
    }else {
        $reclamationController->create();
    }
}
