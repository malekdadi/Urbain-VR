<?php


require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../config/config.php');


class UserController {
 
    
       
   

    // Affiche tous les utilisateurs
    public function index() {
        $usermodel = new User();
        $users = $usermodel->getAllUsers();
        include '../views/backoffice/list.php';
    }
    
    
        
    // Affiche le formulaire d'ajout
   
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom']; 
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            $role = $_POST['role'];

            $userModel = new User();
            $userModel->createUser($nom, $prenom, $email, $mdp, $role); // id_user inutile ici, auto-incrémenté souvent
            header("Location: index.php?action=list");
            exit;
        }
        include '../views/backoffice/add-user.php';
    }
    
    



    

     // Met à jour un utilisateur
     public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usermodel = new User();
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mdp = !empty($_POST['mdp']) ? password_hash($_POST['mdp'], PASSWORD_DEFAULT) : null;
            $role = $_POST['role'];

            $usermodel->updateUser($id, $nom, $prenom, $email, $mdp, $role);
            header('Location: index.php?action=users');
            exit;
        } else {
            $usermodel = new User();
            $user = $usermodel->getUserById($id);
            include '../views/backoffice/update-user.php';
        }
    }

    
    


   
    // Supprime un utilisateur
    public function delete($id) {
        $usermodel = new User();
        $usermodel->deleteUser($id);
        header('Location: index.php?action=list');
        exit;
    }





 // Affiche les détails d’un utilisateur
 public function show() {
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
        $usermodel = new User();
        $user = $usermodel->getUserById($id_user); // Utilise $id_user et pas $id

        if ($user) {
            include '../views/backoffice/read-user.php';
        } else {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "ID manquant.";
    }
}


public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        require_once './models/User.php';
        $userModel = new User();
        $userModel->create($nom, $prenom, $email, $mdp, $role);

        header('Location: index.php?action=list');
        exit;
    }
}
}