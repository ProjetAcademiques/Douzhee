<?php
    require_once("../CRUD/CRUDJoueur.php");
    require '../../assets/PHPmailer/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
<body>
    <div class="PCIR">
        <h2>Réinitialisation</h2>
        <form action="Reinitialisation.php" method="POST">
            <input name ="E-mail" type="email" placeholder="E-mail"required>   
            <input name="NewPassword" type="password" placeholder="newPassword" required maxlength="25">
            <button type="submit">Envoyer le code de vérification</button>
        </form>
    </div>
</body>
</html>
<?php
if (!empty($_POST['E-mail']) &&  !empty($_POST['NewPassword'])){
    $trouve = verifEmail($_POST['E-mail']);
    if ($trouve){
        $code = rand(0,100000);
        $_SESSION['codeVerification'] = $code;
        $_SESSION['E-mail'] = $_POST['E-mail'];
        $_SESSION['newPassword'] = $_POST['NewPassword'];
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'douzhee12@gmail.com'; 
            $mail->Password = 'oltebmtjpmhoqagk';  
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('douzhee12@gmail.com', 'Douzhee');
            $mail->addAddress($_SESSION['E-mail'], 'Joueur');
            $mail->isHTML(true);
            $mail->Subject = 'Changement de mot de passe';
            $mail->Body    = 'Voici le code de vérification : '.$code;
            if ($mail->send()) {
                header('Location: Verification.php');
                exit();
            } else {
                echo 'Échec de l\'envoi: ' . $mail->ErrorInfo;
            }
        } 
        catch (Exception $e) {
            echo "Erreur d'envoi: {$mail->ErrorInfo}";
        }
    }
    else{
        echo '<script 
                    type="text/javascript"> window.onload = function () { alert("Utilisateur inconnu"); }
                    </script>';
    }
}
?>