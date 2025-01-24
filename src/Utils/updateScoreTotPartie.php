<?php
    require_once("../CRUD/CRUDPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateScoreTot($_POST['scoreTot'], $_POST['idPartie']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>