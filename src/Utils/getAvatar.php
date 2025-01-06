<?php
    if (!empty($_POST['testdesecurité'])){
        require_once("../CRUD/CRUDJoueur.php");

        session_start();

        if (isset($_SESSION['userId'])) {
            $avatarUrl = readAvatarById($_SESSION['userId']);
            echo json_encode(['status' => 'success', 'avatarUrl' => $avatarUrl]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>