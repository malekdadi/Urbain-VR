<?php

class User {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'PROJET';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }
   
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    

    // Méthode pour récupérer un utilisateur par ID
    public function getUserById($id_user) {
        $sql = "SELECT * FROM user WHERE id_user = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifie si l'utilisateur existe
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;  // Si aucun utilisateur n'est trouvé
        }

    }
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    

    public function addUser($nom, $prenom, $email, $mdp, $role) {
        $sql = "INSERT INTO user (nom, prenom, email, mdp, role) 
                VALUES (:nom, :prenom, :email, :mdp, :role)";
        $stmt = $this->pdo->prepare($sql);

        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mdp' => $mdpHash,
            ':role' => $role
        ]);
    }
 

    
    public function updateUser($id_user, $nom, $prenom, $email, $role, $mdp = null) {
        if ($mdp) {
            $sql = "UPDATE user SET nom = ?, prenom = ?, email = ?, role = ?, mdp = ? WHERE id_user = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $email, $role, password_hash($mdp, PASSWORD_DEFAULT), $id_user]);
        } else {
            $sql = "UPDATE user SET nom = ?, prenom = ?, email = ?, role = ? WHERE id_user = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $email, $role, $id_user]);
        }
    }
    

    public function deleteUser($id_user) {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        return $stmt->execute();
    }



    public function countUsers() {
    $query = "SELECT COUNT(*) as total FROM user";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

}

