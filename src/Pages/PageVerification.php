<?php
    require_once('pdo.php');
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageVerification</title>
    <link rel="stylesheet" href="style_PCIR.css">
</head>
<body>
    <div class="PCIR">
                <h2>Saisir le code</h2>
                <form action = "PageVerification.php" method="POST">
                    <input name="codeVerification" type="text" placeholder="Code de vérification" required>
                    <button type="submit">Valider le code</button>
                </form>
</body>
</html>
<?php
    if (!empty($_POST['codeVerification'])){
        if ($_POST['codeVerification'] == $_SESSION['codeVerification']){
            updatePassword($_SESSION['newPassword'],$_SESSION['E-mail']);
            header('Location: Page_Connexion.php');
        }else{
            echo '<script 
            type="text/javascript"> window.onload = function () { alert("Mauvais code de verification"); }
            </script>';
        }
    }
?>