<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDSkinAchetable.php");
?>
    <link rel="stylesheet" href="../../assets/CSS/Theme.css">
    <link rel="stylesheet" href="../../assets/CSS/styleBoutique.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>
    <div id="Boutique">
        
        <button class="nav" id="navUp">
            <i class="fa-solid fa-chevron-up"></i>
        </button>

        <div class="container">
            <div id="Theme" class="store">
                <h2>Thèmes</h2>
                <div class="sold">
                </div>
            </div>

            <div id="Musique" class="store">
                <h2>Musiques</h2>
                <div class="sold">

                </div>
            </div>
        </div>
        
        <button class="nav" id="navDown">
            <i class="fa-solid fa-chevron-down"></i>
        </button>
    </div>

    <script src="../../assets/JS/updateBoutique.js"></script>
    <script src="../../assets/JS/modalSkin.js"></script>
    <script src="../../assets/JS/modalMusic.js"></script>
    <script src="../../assets/JS/scriptBoutique.js"></script>
</body>
</html>