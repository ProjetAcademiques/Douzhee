<?php
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateNbDouzhee($_SESSION['userId'], $_POST['nbDouzhee']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>