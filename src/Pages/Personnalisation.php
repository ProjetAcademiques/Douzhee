<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");

    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }

    $joueur = readJoueur($_SESSION['userId']);
    $allThemeAchete = readAllThemeByUser($_SESSION['userId']);
    $allMusiqueAchete = readAllMusicByUser($_SESSION['userId']);
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/stylePersonnalisation.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
<body>
    <?php
        require_once("../Utils/headerBody.php");
    ?>

    <div id="containerPersonalisation">
        <h1>Personnalisation</h1>
        <div id="nameContainer" class="container">
            <h2>pseudo</h2>
            <input type="text" id="pseudoInput" value="<?php echo $joueur->getPseudo() ?>">
        </div>

        <div id="descriptionContainer" class="container">
            <h2>Description</h2>
            <textarea id="descriptionInput" rows="4" cols="50"><?php echo $joueur->getBio() ?></textarea>
        </div>

        <div id="skinContainer" class="container containerItem">
            <h2>Themes</h2>
            <div>
                <?php foreach ($allThemeAchete as $theme) { ?>
                    <div class='item themeItem' id='<?php echo $theme['idSkin']; ?>'>
                        <img src='../../assets/images/imagePersonnalisation/Theme<?php echo $theme['idSkin']; ?>.png' alt='Theme Image'>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div id="musiqueContainer" class="container containerItem">
            <h2>Musiques</h2>
            <div>
                <?php foreach ($allMusiqueAchete as $musique) { ?>
                    <div class='item musicItem' id='<?php echo $musique['idSkin']; ?>'>
                        <img src='../../assets/images/imagePersonnalisation/imgMusique.png' alt='Musique Image'>
                    </div>
                <?php } ?>
            </div>
        </div>

        <button id="valider">Valider</button>
    </div>
    <script type="module" src="../../assets/JS/scriptPersonnalisation.js"></script>
</body>
</html>