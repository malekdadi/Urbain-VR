<?php
require_once '../../config/config.php';
require_once '../../models/User.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=users_export.csv');

$output = fopen('php://output', 'w');

// En-tête du fichier CSV
fputcsv($output, ['ID', 'Nom', 'Prenom', 'Email', 'Role']);

$db = new config();
$pdo = $db->getConnexion();

$userModel = new User($pdo);

// Récupérer tous les utilisateurs
$users = $userModel->getAllUsers();

foreach ($users as $user) {
    fputcsv($output, [
        $user['id_user'],
        $user['nom'],
        $user['prenom'],
        $user['email'],
        $user['role']
    ]);
}

fclose($output);
exit;
?>
