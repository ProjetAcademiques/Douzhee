<?php
require_once("../CRUD/CRUDDefis.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomDefis = $_POST['nomDefis'] ?? ''; // ?? '' is equivalent to isset($_POST['nomDefis']) ? $_POST['nomDefis'] : ''
    $descriptionDefis = $_POST['descriptionDefis'] ?? '';
    $gainDefis = $_POST['gainDefis'] ?? '';

    $regexGain = '/^(1[0-9]{2}|2[0-4][0-9]|250)$/';

    if (!empty($nomDefis) && !empty($descriptionDefis) && !empty($gainDefis)) {
        if (preg_match($regexGain, $gainDefis)) {
            createDefis($nomDefis, $descriptionDefis, $gainDefis);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Veuillez saisir un gain valide (entre 100 et 250).']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Veuillez remplir tous les champs.']);
    }
}
?>