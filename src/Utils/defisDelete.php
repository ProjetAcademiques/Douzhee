<?php
    require_once("../CRUD/CRUDDefiSelected.php");
    $date = date('Y-m-d');

    /*
    if (date('w') == 0 && date('H') == 0) {
        deleteAllDefisSelected();
        header('Location: ../Pages/Defis.php');
        exit();
    }
    else{
        echo "ta cru quoi ptit enculer";
    }
    */

    deleteAllDefisSelected();
?>