<?php
    if (!empty($_POST['testdesecurité'])){
        if (isset($_SESSION['userId'])){
            $allAchats = readAllAchatByUser($_SESSION['userId']);
            $musicPath = readMusicPath($_SESSION['userId']);
        }
        if (isset($allAchats) && is_array($allAchats)  ){
            foreach($allAchats as $achats){
                $themeId = $achats['idSkin'];
                $etatSkin = $achats['etatSkin'];
                $typeSkin = $achats['typeSkin'];
                if ($typeSkin == "Theme" && $etatSkin == 1){
                    switch($themeId){
                        case 1:
                            echo json_encode(['theme' => 'purple']);
                            break;
                        case 2:
                            echo json_encode(['theme' => 'green']);
                            break;
                        case 3:
                            echo json_encode(['theme' => 'red']);
                            break;
                        case 4:
                            echo json_encode(['theme' => 'blue']);
                            break;
                        default:
                            echo json_encode(['theme' => 'purple']);
                            break;
                    }
                }
            }
        }
        else{
            echo json_encode(['theme' => 'purple']);
        }
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>