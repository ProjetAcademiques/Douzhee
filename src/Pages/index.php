<?php
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <?php require_once("../Utils/headerBody.php"); ?>
    <div id="fonctionnalites">
        <div class="sectionHaute">
            <a href="./regles.php" id="regles" class="taches themeItem3">
                <span>Règles</span>
                <img src="../../assets/Images/imageindex/robot1.png" alt="" class="">
            </a>

            <a href="./Classement.php" id="classement" class="taches themeItem3">
                <span>Classement</span>
                <img src="../../assets/Images/imageindex/classement.png" alt="" class="">
            </a>
        </div>

        <div class="sectionMilieu">            
            <a href="./CreaRej.php" id="versushuman" class="taches themeItem4">
                <div id="imgProfile1">
                    <img src="../../assets/Images/imageindex/human.png" alt="human">
                </div>

                <p class="trait1"></p>
                <div class="cache themeItem4" id="cache1"></div>

                <span>VS</span>

                <p class="trait2"></p>
                <div class="cache themeItem4" id="cache2"></div>

                <div id="imgProfile2">
                    <img src="../../assets/Images/imageindex/human.png" alt="human">
                </div>
            </a>
        </div>

        <div class="sectionBasse">
            <a href="./Boutique.php" id="boutique" class="taches themeItem4">
                <span>Boutique</span>
                <img src="../../assets/Images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="">
            </a>

            <a href="./historique.php" id="historique" class="taches themeItem4">
                <span>Historique</span>
            </a>
        </div>
    </div>

    <script src="../../assets/JS/animationIndex.js"></script>
    <script type="module" src="../../assets/JS/scriptIndex.js"></script>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
        header('Location: ../Utils/logout.php');
    }
?>