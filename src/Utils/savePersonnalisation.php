<?php
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    if(isset($_POST['testdesecurité'])) {
        updateBio($_SESSION['userId'], $_POST['description']);
        updateMusicPath($_SESSION['userId'], $_POST['music']);
        updateJoueurIdTheme($_SESSION['userId'], $_POST['theme']);
        updatePseudoJoueur($_SESSION['userId'], $_POST['pseudo']);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'unsuccess', 'error' => 'Erreur lors de la mise à jour.']);
    }

?>