<?php
    session_start();

    if (!empty($_POST['testdesecurité'])) {
        require_once("../CRUD/CRUDJoueur.php");
        require_once("../CRUD/CRUDSkinAchete.php");

        if (isset($_SESSION['userId'])) {
            $allAchats = readAllAchatByUser($_SESSION['userId']);
            if (is_array($allAchats)) {
                echo json_encode(['status' => 'success', 'data' => $allAchats]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No achats found']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>