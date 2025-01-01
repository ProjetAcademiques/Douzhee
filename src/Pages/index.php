<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerBody.php");
    if (isset($_SESSION['messageSucces1'])){
        echo '<script>alert("' . $_SESSION['messageSucces1'] . '");</script>';
        unset($_SESSION['messageSucces1']);
    }
?>
    <link rel="stylesheet" href="../../assets/css/styleIndex.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
    <div id="fonctionnalites">
        <a href="./regles.php" id="regles" class="taches">
            <span>Règles</span>
            <img src="../../assets/Images/imageindex/robot1.png" alt="" class="">
        </a>
        <a href="./Classement.php" id="classement" class="taches"></a>
        <a id="versusrobot" class="taches"></a>
        <a href="./CreaRej.php" id="versushuman" class="taches"></a>
    </div>

    <script src="../../assets/JS/animationIndex.js"></script>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
        header('Location: ../Utils/logout.php');
    }
?>