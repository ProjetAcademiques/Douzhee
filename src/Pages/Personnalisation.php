<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDSkinAchete.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/stylePersonnalisation.css">
</head>
<?php
    require_once("../Utils/headerBody.php");
    $allAchats = readAllAchatByUser($_SESSION['userId']);
?>        
<body>
    <div class="Personnalisation.php">
        <form action="Personnalisation.php" method="POST"  enctype="multipart/form-data">
            <div class="input-input-group">
                <div class="input-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudoPers" name="pseudo" value="<?php echo getPseudoById($_SESSION['userId']) ?>" maxlength="50">
                </div>
                <div class="input-group">
                    <label for="Avatar"class="file-label">+</label>
                    <input type="file" name="avatar" id="Avatar" class="file-input" accept="image/*">
                </div>
            </div>

           
            <div class="input-group">
                <label for="Bio">Bio</label>
                <textarea id="BioPers" name="bio"><?php echo getBioById($_SESSION['userId'])?></textarea>
            </div>

            <div class="input-group">
                <label for="Themes">Themes</label>
                <div class="radio-group">
                    <input type="radio" id="Themes1" name="themes" value="theme1" checked>
                    <input type="radio" id="Themes2" name="themes" value="theme2" disabled>
                    <input type="radio" id="Themes3" name="themes" value="theme3" disabled>
                    
                </div>
            </div>
            <div class="input-group">
                <label for="Dés">Dés</label>
                <div class="radio-group">
                    <input type="radio" id="Des1" name="des" checked>
                    <input type="radio" id="Des2" name="des" disabled>
                    <input type="radio" id="Des3" name="des" disabled>
                </div>
            </div>
            <button id="buttonPers" type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['pseudo'])){
            updatePseudoJoueur($_SESSION['userId'], $_POST['pseudo']);
            header('Location: Profil.php');
        }if(!empty($_POST['bio'])){
            updateBio($_SESSION['userId'], $_POST['bio']);

        }if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
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
                break;
            case 'theme2':
                updateEtatSkin(1,0,$_SESSION['userId']);
                updateEtatSkin(2,1,$_SESSION['userId']);
                updateEtatSkin(3,0,$_SESSION['userId']);
                break;
            case 'theme3':
                updateEtatSkin(1,0,$_SESSION['userId']);
                updateEtatSkin(2,0,$_SESSION['userId']);
                updateEtatSkin(3,1,$_SESSION['userId']);
                break;
        }
    }
    

}if (is_array($allAchats)) {
    foreach ($allAchats as $achats) {
        $themeId = $achats['idSkin'];
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const theme = document.getElementById("Themes<?php echo $themeId; ?>");
                theme.style.backgroundImage = 'url("../../assets/images/imagePersonnalisation/Theme<?php echo $themeId; ?>.png")';
                theme.disabled = false; 
            });
        </script>
        <?php
    }
}
?>
    <?php

?>
  <script>
        const img_ = document.getElementsByClassName("file-label")[0]
        img_.style.backgroundImage = 'url("<?php echo readAvatarById($_SESSION['userId']); ?>")'
    </script>