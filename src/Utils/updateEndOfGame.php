<?php
    require_once("../CRUD/CRUDStatistiques.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateEndOfGame($_SESSION['userId'], $_POST['idPartie']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>