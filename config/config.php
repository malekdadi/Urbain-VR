<?php

<<<<<<< HEAD
class config

{   private static $pdo = null;

    public static function getConnexion()

    {

        if (!isset(self::$pdo)) {

            $servername="localhost";

            $username="root";

            $password ="";

            $dbname="PROJET";

            try {

                self::$pdo = new PDO("mysql:host=$servername;dbname=$dbname",

                        $username,

                        $password

                   

                );

                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

               

                echo "connected successfully";

            } catch (Exception $e) {

                die('Erreur: ' . $e->getMessage());

            }

        }

        return self::$pdo;

    }

}

config::getConnexion();

?>
=======
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
>>>>>>> ddd3c8ece655dc62d71f931071983639e4f94699
