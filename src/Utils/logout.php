<?php
    require_once("headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
    if (isset($_SESSION['timeStart'])){
        $_SESSION['timeEnd'] = microtime(true);
        $delai = $_SESSION['timeEnd'] - $_SESSION['timeStart'];
        updateTempsJeu($_SESSION['userId'],$delai);
    }
    session_destroy();
    header("Location: /douzhee/src/Pages/index.php");
    exit();
?>