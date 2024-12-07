<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDObtient.php");
    require_once("../CRUD/CRUDSkinAchete.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
<body>
    <div class="PCIR">
        <h2>Inscription</h2>
        <form action = "Inscription.php" method="POST">
            <input name="E-mail" type="email" placeholder="E-mail" required>
            <input name="Pseudo" type="text" placeholder="Username" required maxlength="30" title="Longueur maximale 30 caractère!">
            <input name = "Password" type="password" placeholder="Password" required maxlength="25" title="Longueur maximale 25 caractère!">
            <button type="submit">Inscription</button>
        </form>
    </div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['E-mail']) && !empty($_POST['Pseudo']) && !empty($_POST['Password'])){
            $dejaExistant = verifEmail($_POST['E-mail']);
            if ($dejaExistant){
                echo '<script 
                type="text/javascript"> window.onload = function () { alert("Utilisateur déja existant pour cette adresse mail!"); }
                </script>';
            }
            else{
                insertUser($_POST['E-mail'],$_POST['Password'],$_POST['Pseudo']);
                $_SESSION['userId'] = getIdUser($_POST['E-mail']);
                createStatistiques($_SESSION['userId']);
                createClassement(getPseudoById($_SESSION['userId']),$_SESSION['userId']);
                createObtient($_SESSION['userId'],1);
                $_SESSION['timeStart'] = microtime(true); 
                createSkinAchete(1,$_SESSION['userId'],1,"Theme",date("Y/m/d"));
                $_SESSION['messageSucces1'] = "Bravo, vous venez d'obtenir le succès suivant : Se connecter pour la première fois";
                header('Location: Index.php');
             }
        }
    }
?>