<?php
    session_start();
    require_once("../CRUD/CRUDJoueur.php");

    if(isset($_POST['testdesecurité'])){
        if (isset($_SESSION['userId'])){
            echo json_encode(['status' => 'success', 'theme' => readIdThemeJoueur($_SESSION['userId']), 'music' => readMusiqueJoueur($_SESSION['userId'])]);
        }
        else{
            echo json_encode(['status' => 'unsuccess', 'error' => 'Vous n\'êtes pas connecté.']);
        }
    }else{
        echo "tu t'es cru ou toi, hein?";
    }
?>