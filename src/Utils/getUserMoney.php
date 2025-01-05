<?php
    session_start();
    require_once("../CRUD/CRUDJoueur.php");
    
    if (!empty($_POST['testdesecurité'])) {
        if (!empty($_SESSION['userId'])) {
            $resultat = getMoneyById($_SESSION['userId']);
            echo json_encode(['status' => 'success', 'resultat' => $resultat]);
            exit();
        } else {
            echo json_encode(['status' => 'unsucces']);
            exit();
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }

?>