<?php

class Commentaire {
    private $db;

    public function __construct() {
        // Connexion à la base de données via PDO
        $this->db = new PDO('mysql:host=localhost;dbname=reclamation_db', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Récupérer tous les commentaires
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM commentaire ORDER BY date_creation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un commentaire par son ID
    public function getById($id_com) {
        $stmt = $this->db->prepare("SELECT * FROM commentaire WHERE id_com = :id");
        $stmt->execute([':id' => $id_com]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouveau commentaire
    public function create($nom, $email, $commentaire) {
        $stmt = $this->db->prepare("INSERT INTO commentaire (nom, email, commentaire, date_creation) VALUES (:nom, :email, :commentaire, NOW())");
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':commentaire' => $commentaire
        ]);
    }

    // Mettre à jour un commentaire existant
    public function update($id_com, $nom, $email, $commentaire) {
        $stmt = $this->db->prepare("UPDATE commentaire SET nom = :nom, email = :email, commentaire = :commentaire WHERE id_com = :id");
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':commentaire' => $commentaire,
            ':id' => $id_com
        ]);
    }

    // Supprimer un commentaire
    public function delete($id_com) {
        $stmt = $this->db->prepare("DELETE FROM commentaire WHERE id_com = :id");
        $stmt->execute([':id' => $id_com]);
    }
}
