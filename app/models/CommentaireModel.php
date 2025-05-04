<?php
class CommentaireModel {
    private $db;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=reclamation_db', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Créer un commentaire
    public function create($nom_com, $commentaire) {
        $stmt = $this->pdo->prepare('INSERT INTO commentaire (nom_com, commentaire, date_creation) VALUES (?, ?, NOW())');
        return $stmt->execute([$nom_com, $commentaire]);
    }

    // Lire tous les commentaires
    public function getAll() {
        $query = "SELECT * FROM commentaire ORDER BY id DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire un commentaire spécifique
    public function getById($id) {
        $query = "SELECT * FROM commentaire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un commentaire
    public function update($id, $nom_com, $commentaire) {
        $query = "UPDATE commentaire SET nom_com = :nom_com, commentaire = :commentaire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_com', $nom_com);
        $stmt->bindParam(':commentaire', $commentaire);
        return $stmt->execute();
    }

    // Supprimer un commentaire
    public function delete($id) {
        $query = "DELETE FROM commentaire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>