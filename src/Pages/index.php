<?php
require_once("header.php");
require_once("pdo.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="styleindex.css">
</head>
<body>
<div id="fonctionnalites">
        <div id="sectionHaut">
            <form action="règles.php" method="GET">
                <input id="regles" type="submit" value="">
            </form>
            <form action="classement.php" method="GET">
                <input id="classement" type="submit" value="">
            </form>
        </div>
        <div id="sectionBas">
            <form action="versusrobot.php" method="GET">
                <input id="versusrobot" type="submit" value="">
            </form>
            <form action="versushuman.php" method="GET">
                <input id="versushuman" type="submit" value="">
            </form>
        </div>
    </div>
</body>
</html>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])){
    header('Location: logout.php');
    exit();
 }
?>