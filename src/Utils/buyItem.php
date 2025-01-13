<?php 
    require_once("../CRUD/CRUDSkinAchete.php");
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    header('Content-Type: application/json');

    if(isset($_POST['id']) && isset($_POST['testdesecurité'])) {
        $idSkin = intval($_POST['id']);
        $cost = intval($_POST['cost']);
        $userId = $_SESSION['userId'];
        $userMoney = getMoneyById($userId) ?? 0; 
        if ($userMoney >= $cost) {
            $newMoney = $userMoney - $cost;
            updateDouzCoin($userId, $newMoney);
            createSkinAchete($idSkin, $userId, 0, "Theme", date("Y-m-d"));
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'unsuccess', 'error' => 'Fonds insuffisants.']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>