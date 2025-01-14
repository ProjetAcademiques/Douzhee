<?php
    session_start();
    require_once("../CRUD/CRUDJoueur.php");

    header('Content-Type: application/json');

    if (!empty($_POST['testdesecurité'])) {
        if (isset($_SESSION['userId'])) {
            echo json_encode(['theme' => readIdThemeJoueur($_SESSION['userId'])]);
        } else {
            echo json_encode(['theme' => 'purple']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>