<?php
   ob_start();
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    require_once("../Utils/headerBody.php");

    $allAchats = readAllAchatByUser($_SESSION['userId']);
    $achat = readEffecuteAchatById($_SESSION['userId']);
   

?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
       
    <div class="Personnalisation">
        <form action="Personnalisation.php" method="POST"  enctype="multipart/form-data">
            <div class="input-input-group">
                <div class="input-group">
                    <label for="pseudoPers">Pseudo</label>
                    <input type="text" id="pseudoPers" name="pseudo" value="<?php echo getPseudoById($_SESSION['userId'])['pseudonyme'] ?>" maxlength="25">
                </div>
                <div class="input-group">
                    <label for="Avatar"class="file-label">+</label>
                    <input type="file" name="avatar" id="Avatar" class="file-input" accept="image/*">
                </div>
            </div>

           
            <div class="input-group">
                <label for="BioPers">Bio</label>
                <textarea id="BioPers" name="bio" maxlength="500"><?php echo getBioById($_SESSION['userId'])['biographie']?></textarea>
            </div>

            <div class="input-group">
                <label for="Themes1">Themes</label>
                <div class="radio-group">
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
                    <input type="radio" id="Themes4" name="themes" value="theme4" <?php echo ($etatSkinChecked == 1 && $idSkin == 4) ? 'checked' : ''; ?> disabled>
                    
                </div>
            </div>
            <div class="input-group">
                <label for="Musique5">Musique</label>
                <div class="radio-group">
                <?php
                    foreach($achat as $achats){
                        if ($achats['idSkin'] > 4){
                            $etatSkin = $achats['etatSkin'];
                            $idSkin2 = $achats['idSkin'];
                            if ($achats['etatSkin'] == 1) {
                                $etatSkinChecked = 1; 
                                break; 
                        }
                    }
                        }
                    ?>
                    <input type="radio" id="Musique5" name="musique" value="musique5" <?php echo ($etatSkinChecked == 1 && $idSkin2 == 5) ? 'checked' : ''; ?> disabled>
                    <input type="radio" id="Musique6" name="musique" value="musique6" <?php echo ($etatSkinChecked == 1 && $idSkin2 == 6) ? 'checked' : ''; ?> disabled>
                    <input type="radio" id="Musique7" name="musique" value="musique7" <?php echo ($etatSkinChecked == 1 && $idSkin2 == 7) ? 'checked' : ''; ?> disabled>
                    <input type="radio" id="Musique8" name="musique" value="musique8" <?php echo ($etatSkinChecked == 1 && $idSkin2 == 8) ? 'checked' : ''; ?> disabled>
                </div>
            </div>
            <button id="buttonPers" type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>
<?php
if (is_array($allAchats)) {
    foreach ($allAchats as $achats) {
        $themeId = $achats['idSkin'];
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {     
                if ("<?php echo $themeId; ?>" > 4){
                    const musique =document.getElementById("Musique<?php echo $themeId; ?>");
                    musique.style.backgroundImage = 'url("../../assets/images/imagePersonnalisation/imgMusique.png")';  
                    musique.disabled = false;
                }else{
                    const theme = document.getElementById("Themes<?php echo $themeId; ?>");
                    console.log(<?php echo $themeId;?>)
                    theme.style.backgroundImage = 'url("../../assets/images/imagePersonnalisation/Theme<?php echo $themeId; ?>.png")';
                    theme.disabled = false; 
                }
                
            });
        </script>
        <?php
    }
}
    
?>
  <script>
        const img_ = document.getElementsByClassName("file-label")[0]
        img_.style.backgroundImage = 'url("<?php echo readAvatarById($_SESSION['userId']); ?>")'
    </script>

    <?php
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['pseudo'])){
            updatePseudoJoueur($_SESSION['userId'], $_POST['pseudo']);
            
        }if(!empty($_POST['bio'])){
            updateBio($_SESSION['userId'], $_POST['bio']);

        }if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif' , 'image/jpg'];
            $uploadDir = '../../assets/images/imageavatars/';
            $filename = uniqid() . '_' . basename($file['name']);
            $uploadFile = $uploadDir . $filename;
            $oldAvatar = readAvatarById($_SESSION['userId']);
            if (in_array($file['type'], $allowedTypes) && $file['size'] <= 2000000) { 
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    $relativePath = $uploadDir . $filename; 
                    updateAvatar($relativePath,$_SESSION['userId']);      
                    if ($oldAvatar && $oldAvatar !== '../../assets/images/imageavatars/photodefault.jpg' && file_exists($oldAvatar)) {
                        unlink($oldAvatar);
                    }
                } else {
                    echo '<script 
                    type="text/javascript"> window.onload = function () { alert("Erreur lors du téléchargement"); }
                    </script>';
                }
            } else {
                echo '<script 
                type="text/javascript"> window.onload = function () { alert("Le fichier doit être une image (JPEG, PNG, GIF) de moins de 2 Mo."); }
                </script>';
            }

    }if (!empty($_POST['themes'])){
        $selected_theme = $_POST['themes'];
        switch ($selected_theme) {
            case 'theme1':
                updateEtatSkin(1,1,$_SESSION['userId']);
                updateEtatSkin(2,0,$_SESSION['userId']);
                updateEtatSkin(3,0,$_SESSION['userId']);
                updateEtatSkin(4,0,$_SESSION['userId']);
                break;
            case 'theme2':
                updateEtatSkin(1,0,$_SESSION['userId']);
                updateEtatSkin(2,1,$_SESSION['userId']);
                updateEtatSkin(3,0,$_SESSION['userId']);
                updateEtatSkin(4,0,$_SESSION['userId']);
                break;
            case 'theme3':
                updateEtatSkin(1,0,$_SESSION['userId']);
                updateEtatSkin(2,0,$_SESSION['userId']);
                updateEtatSkin(3,1,$_SESSION['userId']);
                updateEtatSkin(4,0,$_SESSION['userId']);
                break;
            case 'theme4':
                updateEtatSkin(1,0,$_SESSION['userId']);
                updateEtatSkin(2,0,$_SESSION['userId']);
                updateEtatSkin(3,0,$_SESSION['userId']);
                updateEtatSkin(4,1,$_SESSION['userId']);
                break;

        }
    }
    if(!empty($_POST['musique'])){
        $selected_musique = $_POST['musique'];
        switch ($selected_musique) {
            case'musique5':
                updateEtatSkin(5,1,$_SESSION['userId']);
                updateEtatSkin(6,0,$_SESSION['userId']);
                updateEtatSkin(7,0,$_SESSION['userId']);
                updateEtatSkin(8,0,$_SESSION['userId']);
                updateMusicPath("../../assets/audio/MusicAccueil5.mp3",$_SESSION['userId']);
                break;
            case'musique6':
                updateEtatSkin(5,0,$_SESSION['userId']);
                updateEtatSkin(6,1,$_SESSION['userId']);
                updateEtatSkin(7,0,$_SESSION['userId']);
                updateEtatSkin(8,0,$_SESSION['userId']);
                updateMusicPath("../../assets/audio/MusicAccueil6.mp3",$_SESSION['userId']);
                break;
            case'musique7':
                updateEtatSkin(5,0,$_SESSION['userId']);
                updateEtatSkin(6,0,$_SESSION['userId']);
                updateEtatSkin(7,1,$_SESSION['userId']);
                updateEtatSkin(8,0,$_SESSION['userId']);
                updateMusicPath("../../assets/audio/MusicAccueil7.mp3",$_SESSION['userId']);
            case'musique8':
                updateEtatSkin(5,0,$_SESSION['userId']);
                updateEtatSkin(6,0,$_SESSION['userId']);
                updateEtatSkin(7,0,$_SESSION['userId']);
                updateEtatSkin(8,1,$_SESSION['userId']);
                updateMusicPath("../../assets/audio/MusicAccueil8.mp3",$_SESSION['userId']);
                break;
    
    }
    

}
    ob_end_clean();
    header('Location: Profil.php');
    exit;
}
?>