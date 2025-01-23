<?php
require_once("../CRUD/CRUDJouerPartie.php");
session_start();

if (!empty($_POST['testdesecurité'])) {
    if (!empty($_SESSION['userId']) && !empty($_POST['idPartie']) && !empty($_POST['score'])) {
        updateScore($_SESSION['userId'], $_POST['idPartie'], $_POST['score']);
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "tu t'es cru ou toi, hein?";
}
?>