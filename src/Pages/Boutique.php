<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDSkinAchetable.php");
    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
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
                <div id="achatContent">
                    <img id="imageAchat">
                    <audio class="audioAchat" controls>
                        <source src="" type="audio/mpeg" id="audioSource">
                    </audio>
                </div>
                <p id="prixAchat"></p>
                <button id="btnAchat">Acheter</button>
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div> 
        
        <div class="nav" id="navUp">
            <i class="fa-solid fa-chevron-up"></i>
        </div>

        <div class="container">
            
            <div class="nav" id="navLeft">
                <i class="fa-solid fa-chevron-left"></i>
            </div>

            <div id="Theme" class="store">
                <div class="border">
                    <div class="interface">
                        <?php $i = 0; ?>
                        <?php foreach($allThemes as $theme): 
                            $i++;?>
                            <div class="item itemTheme" id="<?= $theme["id"] ?>">
                                <img src="../../assets/Images/imagePersonnalisation/Theme<?= $theme["id"] ?>.png" alt="<?= $theme["nomSkin"] ?>">
                            </div>
                            <?php if ($i%20==0 && sizeof($allThemes) != $i):?>
                                    </div>
                                </div>
                                <div class="border">
                                    <div class="interface">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div id="Musique" class="store">
                <div class="border">
                    <div class="interface">
                        <?php $i = 0; ?>
                        <?php foreach($allMusics as $music): 
                            $i++;?>
                            <div class="item itemMusic" id="<?= $music["id"] ?>">
                                <img src="../../assets/Images/imagePersonnalisation/imgMusique.png" alt="<?= $music["nomSkin"] ?>">
                            </div>
                            <?php if ($i%20==0 && sizeof($allMusics) != $i):?>
                                    </div>
                                </div>
                                <div class="border">
                                    <div class="interface">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="nav" id="navRight">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>

        <div class="nav" id="navDown">
            <i class="fa-solid fa-chevron-down"></i>
        </div>
    </div>

    <script src="../../assets/JS/updateBoutique.js"></script>
    <script src="../../assets/JS/modalItem.js"></script>
    <script src="../../assets/JS/scriptBoutique.js"></script>
</body>
</html>