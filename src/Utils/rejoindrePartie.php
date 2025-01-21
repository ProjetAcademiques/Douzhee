<?php
    require_once("../CRUD/CRUDPartie.php");
    require_once("../CRUD/CRUDJouerPartie.php");

    session_start();

    if(!empty($_POST['testdesecurité'])){
        $lienPartie = $_POST['lien_partie'];
        $partie = readPartieByLien($lienPartie);
        $idPartie = $partie->getId();
        if ($idPartie == -1){
            echo json_encode(['status' => 'unsuccess', 'error' => 'Lien invalide']);
        } else {
            $_SESSION['idPartie'] = $idPartie;
            $_SESSION['lienPartie'] = $lienPartie;
            $idJoueur = $_SESSION['userId'];
            $nbJoueurs = $partie->getNbJoueurs();

            $positionPleine = false;
            if (readPositionIsUsed($idPartie, 2) == 0 && $nbJoueurs >= 2) {
                $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 2);
                $_SESSION["position"] = 2;
                updateIdPartieJoueurById($idJoueur, $idPartie);
            } elseif (readPositionIsUsed($idPartie, 3) == 0 && $nbJoueurs >= 3) {
                $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 3);
                $_SESSION["position"] = 3;
                updateIdPartieJoueurById($idJoueur, $idPartie);
            } elseif (readPositionIsUsed($idPartie, 4) == 0 && $nbJoueurs >= 4) {
                $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 4);
                $_SESSION["position"] = 4;
                updateIdPartieJoueurById($idJoueur, $idPartie);
            } else {
                $positionPleine = true;
            }
            echo json_encode(['status' => 'success', 'positionPleine' => $positionPleine]);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>