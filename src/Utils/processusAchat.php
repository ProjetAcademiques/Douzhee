<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['idSkin']) || !isset($input['cost'])) {
            echo json_encode(['success' => false, 'error' => 'Paramètres manquants dans la requête.']);
            exit;
        }
        $userId = $input['userId'];
        $idSkin = $input['idSkin'] ?? null;
        $cost = $input['cost'] ?? 0;
    
        if ($userId && $idSkin && $cost > 0) {
            $userMoney = getMoneyById( $userId) ?? 0;
            if ($userMoney >= $cost) {
                $newMoney = $userMoney - $cost;
                updateDouzCoin($userId, $newMoney);
                createSkinAchete($idSkin, $userId, 0, "Theme", date("Y-m-d"));
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Fonds insuffisants.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Données invalides.', 'donnees' => $cost, 'donnees2' => $idSkin, 'donnees3' => $userId]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Méthode non autorisée.']);
    }
 ?>