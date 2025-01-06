<?php
require_once ("../CRUD/CRUDSkinAchetable.php");
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['idSkin'])) {
    $id = intval($input['idSkin']); 
    $resultat = readPriceById($id);
    $_SESSION['prixSkin'] = $resultat;
    echo json_encode(['message' => "ID reçu : $id", 'resultat' => $resultat]);
    exit();
} else {
    echo json_encode(['error' => 'ID non fourni']);
    exit();
}

?>
