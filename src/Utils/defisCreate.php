<?php
require_once("../CRUD/CRUDDefis.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomDefis = $_POST['nomDefis'] ?? ''; // ?? est l'équivalent de isset($_POST['nomDefis']) ? $_POST['nomDefis'] : '';
    $descriptionDefis = $_POST['descriptionDefis'] ?? '';
    $gainDefis = $_POST['gainDefis'] ?? '';

    $regexGain = '/^(1[0-9]{2}|2[0-4][0-9]|250)$/';
    if (!empty($testdesecurité)){
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
    else{
        echo "tu t'est cru ou toi";
    }
}
else{
    echo "tu t'est cru ou toi";
}
?>