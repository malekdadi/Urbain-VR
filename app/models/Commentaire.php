<?php
class Commentaire {

    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'reclamation_db';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO(
                'mysql:host=' . $host . ';dbname=' . $dbname,
                $user,
                $pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    // Créer un commentaire
    public function createCommentaire($reclamation_id, $commentaires) {
        $stmt = $this->pdo->prepare("INSERT INTO commentaires (reclamation_id, commentaires) VALUES (:reclamation_id, :commentaires)");
        $stmt->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
        $stmt->bindParam(':commentaires', $commentaires);
        return $stmt->execute();
    }

    // Lire tous les commentaires
    public function getAllCommentaires() {
        $stmt = $this->pdo->query("SELECT * FROM commentaires");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire les commentaires par ID de réclamation
    public function getCommentairesByReclamationId($reclamation_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM commentaires WHERE reclamation_id = :reclamation_id");
        $stmt->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire un commentaire par son ID
    public function getCommentaireById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM commentaires WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modifier un commentaire
    public function updateCommentaire($id, $reclamation_id, $commentaires) {
        $stmt = $this->pdo->prepare("UPDATE commentaires SET reclamation_id = :reclamation_id, commentaires = :commentaires WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
        $stmt->bindParam(':commentaires', $commentaires);
        return $stmt->execute();
    }

    // Supprimer un commentaire
    public function deleteCommentaire($id) {
        $stmt = $this->pdo->prepare("DELETE FROM commentaires WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAll()
{
    $result = $this->mysqli->query("SELECT * FROM commentaires");

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // retourne un tableau vide si aucun résultat
    }
}

    }
?>
