<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    require '../../assets/PHPmailer/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
?>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
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
                exit();
            }
            else{
                if (preg_match($regexEmail, $_POST['E-mail'])){
                    $verifMail = new PHPMailer(true);
                    try{
                        $verifMail->isSMTP();
                        $verifMail->Host = 'smtp.gmail.com';
                        $verifMail->SMTPAuth = true;
                        $verifMail->Username = 'douzhee12@gmail.com'; 
                        $verifMail->Password = 'oltebmtjpmhoqagk';  
                        $verifMail->SMTPSecure = 'ssl';
                        $verifMail->Port = 465;

                        $verifMail->setFrom('douzhee12@gmail.com', 'Douzhee');
                        $verifMail->addAddress($_POST['E-mail'], 'Joueur');
                        $verifMail->isHTML(true);
                        $verifMail->Subject = 'Bienvenue sur Douzhee';
                        $verifMail->Body    = 'Bonjour'.$_POST['Pseudo'].'
                            Merci de vous être inscrit à Douzhee ! 🎲
                            Nous sommes ravis de vous compter parmi nos joueurs. Préparez-vous à lancer les dés, tenter votre chance et montrer vos talents dans ce jeu de Yahtzee en ligne.
                            Si vous avez des questions ou besoin d’aide, notre équipe est là pour vous.
                            À bientôt sur Douzhee,
                            L’équipe Douzhee.';
                        if ($verifMail->send()) {
                            //l'adresse mail existe
                        } else {
                            echo '<script  type="text/javascript"> window.onload = function () { alert("Votre email n existe pas, veuiller en inserer un autre"); }
                         </script>';
                            exit();
                        }                                 
                    }
                    catch (Exception $e) {
                     echo "Erreur d'envoi: {$verifMail->ErrorInfo}";
                 }
                    insertUser($_POST['E-mail'],$_POST['Password'],$_POST['Pseudo']);
                    $_SESSION['userId'] = getIdUser($_POST['E-mail']);
                    createStatistiques($_SESSION['userId']);
                    $pseudo = getPseudoById($_SESSION['userId']);
                    createClassement($pseudo['pseudonyme'],$_SESSION['userId']);
                    $_SESSION['timeStart'] = microtime(true); 
                    createSkinAchete(1,$_SESSION['userId'],"Theme",date("Y/m/d"));
                    createSkinAchete(5,$_SESSION['userId'],"Musique",date("Y/m/d"));
                    $_SESSION['messageSucces1'] = "Bravo, vous venez d'obtenir le succès suivant : Se connecter pour la première fois";
                    $_SESSION['isconnected'] = 1;
                    header('Location: Index.php');
                }
                else{
                    echo '<script  type="text/javascript"> window.onload = function () { alert("Votre email est syntaxiquement incorrect voici un exemple de mail attendu : zikette@gmail.com"); }
                    </script>';
                }
        }
    }
}
?>