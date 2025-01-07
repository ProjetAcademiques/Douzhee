<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDSkinAchetable.php");
    $allThemes = readAllThemes();
    $allMusics = readAllMusics();
?>
    <link rel="stylesheet" href="../../assets/CSS/Theme.css">
    <link rel="stylesheet" href="../../assets/CSS/styleBoutique.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>

    <div id="Boutique">
        <div id="achatContainer">
            <div id="achat">
                <h2>Achat</h2>
                <img id="imageAchat">
                <p id="prixAchat"></p>
                <button id="btnAchat">Acheter</button>
            </div>
        </div>
        
        <div class="nav" id="navUp">
            <i class="fa-solid fa-chevron-up"></i>
        </div>

        <div class="container">
            <div id="Theme" class="store">
                <h2>Theme</h2>
                <div class="interface">
                    <?php foreach($allThemes as $theme): ?>
                        <div class="item" id="<?= $theme["id"] ?>">
                            <img src="../../assets/Images/imagePersonnalisation/<?= $theme["nomSkin"] ?>.png" alt="<?= $theme["nomSkin"] ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="Musique" class="store">
                <h2>Musique</h2>    
                <div class="interface">
                    <?php foreach($allMusics as $music): ?>
                        <div class="item" id="<?= $music["id"] ?>">
                            <img src="../../assets/Images/imagePersonnalisation/imgMusique.png" alt="<?= $music["nomSkin"] ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="nav" id="navDown">
            <i class="fa-solid fa-chevron-down"></i>
        </div>
    </div>

    <script src="../../assets/JS/updateBoutique.js"></script>
    <script src="../../assets/JS/modalSkin.js"></script>
    <script src="../../assets/JS/modalMusic.js"></script>
    <script src="../../assets/JS/scriptBoutique.js"></script>
</body>
</html>