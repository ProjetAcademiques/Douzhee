<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDObtient.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $email_err_mess = null;

    // vérification du format et de l'email en session
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['E-mail']) && !empty($_POST['Pseudo']) && !empty($_POST['Password'])){
            $dejaExistant = verifEmail($_POST['E-mail']);
            if ($dejaExistant){
                /*
                echo '<script 
                type="text/javascript"> window.onload = function () { alert("Utilisateur déja existant pour cette adresse mail!"); }
                </script>';
                */
                $email_err_mess = "Un utilisateur possédant cette adresse mail existe déjà. Veuillez entrer une nouvelle adresse !";
                exit();
            }
            else{
                if (preg_match($regexEmail, $_POST['E-mail'])){
                    insertUser($_POST['E-mail'],$_POST['Password'],$_POST['Pseudo']); 
                    $ID = getIdUser($_POST['E-mail']) ?? -1;
                    if ($ID != -1 && $ID != null) {
                        $_SESSION['userId'] = $ID;
                        var_dump($_SESSION["userId"]); 
                        createStatistiques($_SESSION['userId']);
                        var_dump($_SESSION["userId"]); 
                        $pseudo = getPseudoById($_SESSION['userId']);
                        createClassement($pseudo['pseudonyme'],$_SESSION['userId']);
                        createObtient($_SESSION['userId'],1);
                        $_SESSION['timeStart'] = microtime(true); 
                        createSkinAchete(1,$_SESSION['userId'],1,"Theme",date("Y/m/d"));
                        $_SESSION['messageSucces1'] = "Bravo, vous venez d'obtenir le succès suivant : Se connecter pour la première fois";
                        header('Location: Index.php');
                    } else {
                        $email_err_mess = "problème survenu";
                    }
                }
                else {
                    // echo '<script  type="text/javascript"> window.onload = function () { alert("Votre email est syntaxiquement incorrect voici un exemple de mail attendu : zikette@gmail.com"); }
                    //</script>';
                    $email_err_mess = "Votre email est syntaxiquement incorrect voici le format attendu : nom@domaine.tld";
                }
        }
    }
}
?>

<link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
    <div class="PCIR">
        <h2>Inscription</h2>
        <form action = "Inscription.php" method = "POST">
            <input name="E-mail" type="email" placeholder="E-mail" required>
            <span style = "color : red">
                <!-- ERR MESSAGE -->
                <?php echo $email_err_mess ?? ""?>;
            </span>
            <input name="Pseudo" type="text" placeholder="Username" required maxlength="30" title="Longueur maximale 30 caractère!">
            <input name = "Password" type="password" placeholder="Password" required maxlength="25" title="Longueur maximale 25 caractère!">
            <button type="submit">Inscription</button>
        </form>
    </div>
</body>
</html>