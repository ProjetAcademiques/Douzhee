<?php
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateIdPartieJoueurById($_SESSION['userId'], $_POST['idPartie']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>