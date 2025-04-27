<?php
require_once '../app/controllers/ReclamationController.php';

define('VIEWS_PATH', __DIR__ . '/../app/views/');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$controller = new ReclamationController();
$action = $_GET['action'] ?? 'create';
$id = $_GET['id'] ?? null;

if ($action === 'update' && $id) {
    $controller->update($id);
} elseif ($action === 'delete' && $id) {
    $controller->delete($id);
} elseif ($action === 'send_mail') {
    $controller->sendMail($id);
} elseif ($action === 'index') { // 👉 ici on affiche la liste triée
    $controller->index();
}elseif ($action === 'download_pdf') {
    $controller->downloadPdf();
}elseif ($action === 'download_excel') {
    $controller->downloadExcel();
}elseif ($action === 'stats') {
    $controller->afficherStatistiquesMessages(); // ✅ correct
}

 else {
    $controller->create();
}
