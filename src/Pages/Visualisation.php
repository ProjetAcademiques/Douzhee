<?php
 require_once("../CRUD/CRUDJoueur.php");
 require_once("../Utils/headerInit.php");
 require_once("../CRUD/CRUDClassement.php");
 require_once("../CRUD/CRUDStatistiques.php");
 require_once("../Utils/headerBody.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $pseudonyme = getPseudoById($id)['pseudonyme'];
    $biographie = getBioById($id)['biographie'];
    $path = readAvatarById($id);
    $achat = readEffecuteAchatById($id);
    $statsUser = readStatistiquesByIdUser($id);
} else {
}
   
?>
 <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
 <link rel="stylesheet" href="../../assets/CSS/styleVisualisation.css">
</head>

    <div class="Visualisation">
        <div class="Group">
               <div class="Input-Group">
                    <label for="Pseudo">Pseudo : </label>
                    <input type="text" id="Pseu" value="<?php echo $pseudonyme ?>" disabled></input>
                </div>
                <div clas="Input-Group">
                    <img src="<?php echo $path ?>" alt="Avatar" class="AvatarVisu">
                </div>
            
        </div>
        <div class="Input-Group">
            <label for="Bio">Biographe : </label>
            <input type="text" id="Biog" value="<?php echo $biographie?>" disabled></input>
        </div>
        <div class="Input-Group">
            <label for="Themes">Themes : </label>
            <div class="Radio-Group">
                <?php
                foreach($achat as $achats){
                    $etatSkin = $achats['etatSkin'];
                    $idSkin = $achats['idSkin'];
                    if ($achats['etatSkin'] == 1) {
                        $etatSkinChecked = 1; 
                        break; 
                    }
                }
                ?>
                     <input type="radio" id="Themes1" name="themes" value="theme1" <?php echo ($etatSkinChecked == 1 && $idSkin == 1) ? 'checked' : ''; ?> disabled>
                     <input type="radio" id="Themes2" name="themes" value="theme2" <?php echo ($etatSkinChecked == 1 && $idSkin == 2) ? 'checked' : ''; ?> disabled>
                     <input type="radio" id="Themes3" name="themes" value="theme3" <?php echo ($etatSkinChecked == 1 && $idSkin == 3) ? 'checked' : ''; ?> disabled>
            </div>
        </div>
        <div class="Input-Group">
            <label>Statistiques de <?php echo $pseudonyme?> : </label>
        <div class="State">
        <h2>Parties Jouées :</h2>
        <?php echo $statsUser->getnbPartieJoues() ?>
    </div>
    <div class="State">
        <h2>Parties Gagnées <img src="../../assets/images/imageStates/nbPartiesGagnes.png"></img> :</h2>
        <?php echo $statsUser->getNbPartiesGagnees()?>
    </div>
    <div class="State">
        <h2>Ratio Victoire :</h2>
        <?php echo $statsUser->getRatioVictoire() ?>
    </div>
    <div class="State">
        <h2>Succès <img src="../../assets/images/imageStates/succes.png"></img> :</h2>
        <?php echo $statsUser->getNbSucces() ?>
    </div>
    <div class="State">
        <h2>Score <img src="../../assets/images/imageStates/scoremax.png"></img> :</h2>
        <?php echo $statsUser->getScoreMaximal() ?>
    </div>
    <div class="State">
        <h2>Douzhee <img src="../../assets/images/imageStates/nbDouzhee.png"></img> :</h2>
       <?php echo  $statsUser->getNbDouzhee()?>
    </div>
    <div class="State">
        <h2>Temps de jeu <img src="../../assets/images/imageStates/tempsjeu.png"></img> :</h2>
        <?php echo $statsUser->getTempsJeu() ?>
    </div>
        </div>
    </div>
</body>
</html>