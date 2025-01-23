<?php
    require_once("headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");

    if(!empty($_POST['testdesecurité'])){
        if (isset($_SESSION['timeStart'])){
            $_SESSION['timeEnd'] = microtime(true);
            $delai = $_SESSION['timeEnd'] - $_SESSION['timeStart'];
            updateTempsJeu($_SESSION['userId'],$delai);
        }
        session_destroy();
    } else{
        echo "tu t'es cru ou toi, hein?";
    }
?>