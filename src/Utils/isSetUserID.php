<?php
    session_start();

    if (!empty($_POST['testdesecurité'])){   
        if (isset($_SESSION['userId'])){
            echo json_encode(['status' => 'success', 'id' => $_SESSION['userId']]);
        } else{
            echo json_encode(['status' => 'unsucess']);
        }
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>