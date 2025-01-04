<?php
    if (!empty($_POST['testdesecurité'])){
        require_once("../CRUD/CRUDDefiSelected.php");
        $date = date('Y-m-d'); // récupère la date du jour

        deleteAllDefisSelected();
        header('Location: ../Pages/Defis.php');
        exit();
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>