<?php
    if (!isset($_SESSION['userId'])){
        header('Location: Connexion.php');
        exit;
    }
?>