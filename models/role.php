<?php

require_once(__DIR__ . '/../config/config.php');

class Role {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // 🔵 Récupérer tous les rôles disponibles
    public function getAllRoles() {
        $stmt = $this->pdo->query("SELECT * FROM Role");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔵 Récupérer un rôle par son ID
    public function getRoleById($id_role) {
        $stmt = $this->pdo->prepare("SELECT * FROM Role WHERE id_role = ?");
        $stmt->execute([$id_role]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔵 Ajouter un nouveau rôle (optionnel si tu veux permettre création rôles dynamiques)
    public function createRole($nom_role) {
        $stmt = $this->pdo->prepare("INSERT INTO Role (nom_role) VALUES (?)");
        return $stmt->execute([$nom_role]);
    }

    // 🔵 Supprimer un rôle (optionnel)
    public function deleteRole($id_role) {
        $stmt = $this->pdo->prepare("DELETE FROM Role WHERE id_role = ?");
        return $stmt->execute([$id_role]);
    }
}
