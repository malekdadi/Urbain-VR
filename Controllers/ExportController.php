<?php
include '../config/database.php'; // Inclure la classe config pour la connexion à la base de données

if (isset($_GET['format']) && $_GET['format'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=rapport_abonnements.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Nom de l\'Abonnement', 'Description', 'Nom du Pack']);

    try {
        // Obtenir la connexion PDO via la classe config
        $pdo = config::getConnexion();

        // Requête pour récupérer les données
        $query = "SELECT a.nom_abon, a.description, p.nom_pac AS nom_pack
                  FROM abonnement a
                  JOIN pack p ON a.id_pack = p.id_pack";
        $stmt = $pdo->query($query);

        // Parcourir les résultats et les écrire dans le fichier CSV
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, [$row['nom_abon'], $row['description'], $row['nom_pack']]);
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

    fclose($output);
    exit;
} else {
    echo "Format non supporté ou paramètre manquant.";
}