<?php
    require_once("../CRUD/CRUDJouerPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateEstGagnant($_SESSION['userId'], $_POST['idPartie']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>