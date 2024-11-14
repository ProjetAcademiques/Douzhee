<?php
    require_once("pdo.php");
  
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="style_PCIR.css"> 
    </head>
    <body>
        <div class="PCIR">
            <h2>Inscription</h2>
            <form action = "Page_Inscription.php" method="POST">
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
        }else{
        insertUser($_POST['E-mail'],$_POST['Password'],$_POST['Pseudo']);
        $_SESSION['user_id'] = getIdUser($_POST['E-mail']);
        header('Location: index.php');
    }
}
}
?>