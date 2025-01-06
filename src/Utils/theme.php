<?php
    session_start();
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");

    header('Content-Type: application/json');

    if (!empty($_POST['testdesecurité'])) {
        if (isset($_SESSION['userId'])) {
            $allAchats = readAllAchatByUser($_SESSION['userId']);
            if (isset($allAchats)) {
                foreach ($allAchats as $achats) {
                    $themeId = $achats['idSkin'];
                    $etatSkin = $achats['etatSkin'];
                    $typeSkin = $achats['typeSkin'];
                    if ($typeSkin == "Theme" && $etatSkin == 1) {
                        switch ($themeId) {
                            case 1:
                                echo json_encode(['theme' => 'purple']);
                                exit;
                            case 2:
                                echo json_encode(['theme' => 'green']);
                                exit;
                            case 3:
                                echo json_encode(['theme' => 'red']);
                                exit;
                            case 4:
                                echo json_encode(['theme' => 'blue']);
                                exit;
                            default:
                                echo json_encode(['theme' => 'purple']);
                                exit;
                        }
                    }
                }
            } else {
                echo json_encode(['theme' => 'error', 'test' => $allAchats]);
            }
        } else {
            echo json_encode(['theme' => 'purple']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>