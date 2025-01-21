<?php
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        echo json_encode(['idPartieEnCours' => readIdPartieJoueurById($_SESSION['userId'])]);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>