<?php
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/CSS/Theme.css">
    <link rel="stylesheet" href="../../assets/CSS/styleBoutique.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
</head>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>
    <div id="Boutique">
        
        <button class="nav" id="navUp">Up</button>

        <div class="container">
            <div id="Theme" class="store">
                <h2>Theme</h2>
                <div class="sold">

                </div>
            </div>

            <div id="Musique" class="store">
                <h2>Musique</h2>    
                <div class="sold">
                    
                </div>
            </div>
        </div>
        
        <button class="nav" id="navDown">Down</button>
    </div>

    <script src="../../assets/JS/updateBoutique.js"></script>
    <script src="../../assets/JS/modalSkin.js"></script>
    <script src="../../assets/JS/modalMusic.js"></script>
    <script src="../../assets/JS/scriptBoutique.js"></script>
</body>
</html>