<?php

// Configuration de la base de données
define('DB_HOST', 'localhost');  // Hôte de la base de données
define('DB_NAME', 'reclamation_db');  // Nom de la base de données
define('DB_USER', 'root');  // Utilisateur de la base de données (par défaut sous XAMPP)
define('DB_PASSWORD', '');  // Mot de passe de la base de données (vide par défaut sous XAMPP)

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    
    // Définir le mode d'erreur de PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Afficher un message de connexion réussie (optionnel)
    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    // Si la connexion échoue, afficher un message d'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
