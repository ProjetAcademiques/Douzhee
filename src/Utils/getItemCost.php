<?php
    require_once("../CRUD/CRUDSkinAchetable.php");
    header('Content-Type: application/json');

    session_start();

    if (!empty($_POST['testdesecurité']) && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $resultat = readPriceById($id);
        if ($resultat !== false) {
            echo json_encode(['status' => 'success', 'resultat' => $resultat]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Item not found']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>