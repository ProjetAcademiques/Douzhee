<?php
    session_start();

    if (!empty($_POST['testdesecurité'])) {
        if (isset($_SESSION['isconnected'])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'unsuccess']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
?>