<?php
    require_once("../CRUD/CRUDJouerPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateScore($_SESSION['userId'], $_POST['idPartie'], $_POST['score']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>