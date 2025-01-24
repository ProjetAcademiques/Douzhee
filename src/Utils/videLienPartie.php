<?php
    require_once("../CRUD/CRUDPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        videLienPartie($_POST['idPartie']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>