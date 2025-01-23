<?php
    require_once("headerInit.php");
    session_destroy();
    header("Location: /douzhee/src/Pages/Connexion.php");
    exit();
?>