<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerBody.php");
    if (isset($_SESSION['messageSucces1'])){
        echo '<script>alert("' . $_SESSION['messageSucces1'] . '");</script>';
        unset($_SESSION['messageSucces1']);
    }
?>
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
    <div id="fonctionnalites">
        <a href="./regles.php" id="regles" class="taches">
            <span>Règles</span>
            <img src="../../assets/Images/imageindex/robot1.png" alt="" class="">
        </a>

        <a href="./Classement.php" id="classement" class="taches">
            <span>Classement</span>
            <img src="../../assets/Images/imageindex/classement.png" alt="" class="">
        </a>

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

    <script src="../../assets/JS/animationIndex.js"></script>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
        header('Location: ../Utils/logout.php');
    }
?>