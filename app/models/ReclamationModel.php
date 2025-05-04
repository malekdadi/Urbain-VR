<?php
class ReclamationModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=reclamation_db", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getStatistiquesMessages() {
        $sql = "
            SELECT
                message, 
                COUNT(*) AS total
            FROM reclamations
            GROUP BY message
            ORDER BY total DESC
        ";
    
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM reclamation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Rechercher les réclamations par nom
    public function rechercherReclamations($nom)
    {
        $query = "SELECT * FROM reclamations WHERE nom LIKE :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => "%$nom%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
