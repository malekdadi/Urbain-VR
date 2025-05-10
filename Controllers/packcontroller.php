<?php

require_once '../Models/pack.php';
require_once '../config/database.php';

class PackController {

    // Affiche tous les packs
    public function index() {
        $packmodel = new Pack();
        $packs = $packmodel->getAllPacks(); // Cette méthode récupère tous les packs
        require_once('../views/backoffice/packs.php'); 
    }
    
    // Affiche le formulaire d'ajout
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $id_abon = $_POST['id_abon'];
            $prix = $_POST['prix'];

            $packModel = new Pack();
            $packModel->createPack($id_user, $id_abon, $prix); // `id_pack` inutile ici, auto-incrémenté
            header("Location: index.php?action=pack");
            exit;
        }
        include '../views/backoffice/add-pack.php'; // Inclut le formulaire pour ajouter un pack
    }

    // Met à jour un pack
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $packmodel = new Pack();
            $id_user = $_POST['id_user'];
            $id_abon = $_POST['id_abon'];
            $prix = $_POST['prix'];

            $packmodel->updatePack($id, $id_user, $id_abon, $prix);
            header('Location: index.php?action=pack');
            exit;
        } else {
            $packmodel = new Pack();
            $pack = $packmodel->getPackById($id);
            include '../views/backoffice/edit-pack.php'; // Affiche le formulaire d'édition pour un pack
        }
    }

    // Supprime un pack
    public function delete($id) {
        $packmodel = new Pack();
        $packmodel->deletePack($id);
        header('Location: index.php?action=pack');
        exit;
    }

    // Affiche les détails d’un pack
    public function show() {
        if (isset($_GET['id'])) {
            $id_pack = $_GET['id'];
            $packmodel = new Pack();
            $pack = $packmodel->getPackById($id_pack); // Utilise $id_pack pour récupérer le pack

            if ($pack) {
                include '../views/backoffice/read-pack.php'; // Affiche les détails du pack
            } else {
                echo "Pack non trouvé.";
            }
        } else {
            echo "ID manquant.";
        }
    }

    // Enregistre un pack
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $id_abon = $_POST['id_abon'];
            $prix = $_POST['prix'];

            $packModel = new Pack();
            $packModel->create($id_user, $id_abon, $prix); // Création d'un nouveau pack

            header('Location: index.php?action=pack');
            exit;
        }
    }
}
