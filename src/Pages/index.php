<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleIndex.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
<?php
    require_once("../Utils/headerBody.php");
    if (isset($_SESSION['messageSucces1'])){
        echo '<script>alert("' . $_SESSION['messageSucces1'] . '");</script>';
        unset($_SESSION['messageSucces1']);
    }
?>
    <div id="fonctionnalites">
        <div id="sectionHaut">
            <form action="Regles.php" method="GET">
                <input id="regles" type="submit" value="">
            </form>
            <form action="Classement.php" method="GET">
                <input id="classement" type="submit" value="">
            </form>
        </div>
        <div id="sectionBas">
            <form action="versusrobot.php" method="GET">
                <input id="versusrobot" type="submit" value="">
            </form>
            <form action="CreaRej.php" method="GET">
                <input id="versushuman" type="submit" value="">
            </form>
        </div>
    </div>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
        header('Location: ../Utils/logout.php');
    }
?>