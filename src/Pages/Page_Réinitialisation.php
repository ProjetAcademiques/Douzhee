<?php
    require_once("pdo.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de réinitialisation</title>
    <link rel="stylesheet" href="style_PCIR.css"> 
    </head>
    <body>
        <div class="PCIR">
            <h2>Réinitialisation</h2>
            <form action="Page_Réinitialisation.php" method="POST">
             <input name ="E-mail" type="email" placeholder="E-mail"required>   
             <input name="Password" type="password" placeholder="Password" required>
             <input name="NewPassword" type="password" placeholder="newPassword" required maxlength="25">
             <button type="submit">Envoyer le code de vérification</button>
            </form>
        </div>
    </body>
</html>
<?php
if (!empty($_POST['E-mail']) && !empty($_POST['Password']) && !empty($_POST['NewPassword'])){
    $trouve = verifUser($_POST['E-mail'],$_POST['Password']);
    if ($trouve){
        $code = rand(0,100000);
        $_SESSION['codeVerification'] = $code;
        $_SESSION['E-mail'] = $_POST['E-mail'];
        $_SESSION['newPassword'] = $_POST['NewPassword'];
        mail($_POST['E-mail'],"changePassword","Voici le code de verification ".$code,"From: Douzhee.fr");
        header('Location: PageVerification.php');
    }else{
        echo '<script 
                    type="text/javascript"> window.onload = function () { alert("Utilisateur inconnu"); }
                    </script>';
    }
}
?>