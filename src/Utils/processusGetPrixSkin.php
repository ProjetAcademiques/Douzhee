<?php
    require_once("../CRUD/CRUDSkinAchetable.php");
    session_start();

    header('Content-Type: application/json');

    if (!empty($_POST['testdesecurité'])) {
        if (!empty($_POST['idSkin'])) {
            $resultat = readPriceById($_POST['idSkin']);
            $_SESSION['prixSkin'] = $resultat;
            echo json_encode(['status' => 'success', 'resultat' => $resultat]);
            exit();
        } else {
            echo json_encode(['status' => 'unsuccess', 'error' => 'ID non fourni']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        exit();
    }
?>
