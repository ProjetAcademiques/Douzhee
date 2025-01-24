<?php
    require_once("../CRUD/CRUDSuccesJoueur.php");
    require_once("../CRUD/CRUDSucces.php");
    require_once("../CRUD/CRUDStatistiques.php");

    if(!empty($_POST['testdesecurité'])){
        if(!(readSuccessJoueur($_POST['idJoueur'], $_POST['idSucces']))){
            createSuccessJoueur($_POST['idJoueur'], $_POST['idSucces']);
            updateNbSucces($_POST['idJoueur']);
            $succes = readSuccesById($_POST['idSucces']);
            echo json_encode(['status' => 'success', 'nomSucces' => $succes->getName()]);
        }
        else{
            echo json_encode(['status' => 'unsucess']);
        }
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>