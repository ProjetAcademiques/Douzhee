<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerBody.php");
    if (isset($_SESSION['messageSucces1'])){
        echo '<script>alert("' . $_SESSION['messageSucces1'] . '");</script>';
        unset($_SESSION['messageSucces1']);
    }
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
    <div id="fonctionnalites">
        <div class="sectionHaute">
            <a href="./regles.php" id="regles" class="taches">
                <span>Règles</span>
                <img src="../../assets/Images/imageindex/robot1.png" alt="" class="">
            </a>

            <a href="./Classement.php" id="classement" class="taches">
                <span>Classement</span>
                <img src="../../assets/Images/imageindex/classement.png" alt="" class="">
            </a>
        </div>

        <div class="sectionMilieu">
            <!--
            <a href="./versusbot.php" id="versusrobot" class="taches">
                <div id="imgProfile1"> 
                    <img src="../../assets/Images/imageindex/robot2.png" alt="robot">
                </div>

                <p class="trait1"></p>
                <div class="cache cache1"></div>

                <span>VS</span>

                <p class="trait2"></p>
                <div class="cache cache2"></div>

                <div id="imgProfile2">
                    <img src="../../assets/Images/imageindex/human.png" alt="human">
                </div>
            </a>
            -->
            
            <a href="./CreaRej.php" id="versushuman" class="taches">
                <div id="imgProfile1">
                    <img src="../../assets/Images/imageindex/human.png" alt="human">
                </div>

                <p class="trait1"></p>
                <div class="cache cache1"></div>

                <span>VS</span>

                <p class="trait2"></p>
                <div class="cache cache2"></div>

                <div id="imgProfile2">
                    <img src="../../assets/Images/imageindex/human.png" alt="human">
                </div>
            </a>
        </div>

        <div class="sectionBasse">
            <a href="./Boutique.php" id="boutique" class="taches">
                <span>Boutique</span>
                <img src="../../assets/Images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="">
            </a>

            <a href="./Defis.php" id="defis" class="taches">
                <span>Defis</span>
            </a>
        </div>
    </div>

    <script src="../../assets/JS/animationIndex.js"></script>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
        header('Location: ../Utils/logout.php');
    }
?>