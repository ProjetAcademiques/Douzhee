<?php
require_once("../CRUD/CRUDJoueurPartie.php");
session_start();

if (!empty($_POST['testdesecurité'])) {
    if (!empty($_POST['idJoueur']) && !empty($_POST['idPartie']) && !empty($_POST['score'])) {
        updateScore($_POST['idJoueur'], $_POST['idPartie'], $_POST['score']);
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "tu t'es cru ou toi, hein?";
}
?>