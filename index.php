<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>indexpack</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  
</head>

<body>


<?php

$title = "Liste des packs";
include 'config/database.php'; 
include 'views/layout.php';





// Autoload controllers & models (ou require manuels)

include './Controllers/packcontroller.php';
include 'models/pack.php';

$db = new Database();
$pdo = $db->getConnexion();

$packController = new PackController($pdo);

// Routing simple
$action = $_GET['action'] ?? 'packs';

switch ($action) {
    case 'packs':
        $packController->index();
        break;
    case 'add_pack':
        $packController->addPack();
        break;
    case 'store_pack':
        $packController->storePack();
        break;
    case 'edit_pack':
        $packController->edit();
        break;
    case 'update_pack':
        $packController->update();
        break;
    case 'delete_pack':
        $packController->deletePack();
        break;
    case 'read_pack':
        $packcontroller->show();
    }
?>



<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>


