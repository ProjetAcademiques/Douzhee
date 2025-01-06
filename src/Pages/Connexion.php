<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    $cookiename = "Email";
    $cookiename2 = "Password";
    $key = "this-is-a-zikette-key-for-a-pass";
    $newemail = isset($_COOKIE[$cookiename]) ? decryptage($_COOKIE[$cookiename], $key) : '';
    $newmdp = isset($_COOKIE[$cookiename2]) ? decryptage($_COOKIE[$cookiename2], $key) : '';
    $email_err_mess = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_COOKIE[$cookiename] ) && !empty($_COOKIE[$cookiename2])){
            $email = decryptage($_COOKIE[$cookiename], $key);
            $mdp = decryptage($_COOKIE[$cookiename2], $key);
            $trouve = verifUser($email,$mdp);
            if ($trouve){
                $_SESSION['userId'] = getIdUser($email);
                $_SESSION['timeStart'] = microtime(true); 
                header('Location: Index.php');
                $_SESSION['isconnected'] = 1;
                exit();
            } 
        }
        if (!empty($_POST['E-mail']) && !empty($_POST['Password'])){  
                $email = $_POST['E-mail'];
                $mdp = $_POST['Password'];    
                if (!empty($_POST['checkbox'])){
                    $cryptedEmail = cryptage($email,$key);
                    $cryptedPassword = cryptage($mdp,$key);
                    setcookie($cookiename, $cryptedEmail, [
                        'expires' => time() + (60 * 60 * 2),
                        'path' => '/',
                        'secure' => true,     
                        'httponly' => true,   
                        'samesite' => 'Strict' 
                    ]);
                    setcookie($cookiename2, $cryptedPassword, [
                        'expires' => time() + (60 * 60 * 2),
                        'path' => '/',
                        'secure' => true,     
                        'httponly' => true,   
                        'samesite' => 'Strict' 
                    ]);
                }
                $trouve = verifUser($_POST['E-mail'],$_POST['Password']);
                if ($trouve){
                        $_SESSION['userId'] = getIdUser($_POST['E-mail']);
                        $_SESSION['timeStart'] = microtime(true); 
                        $_SESSION['isconnected'] = 1;
                        header('Location: Index.php');
                        exit();
                } else {
                    /*
                        echo '<script 
                                    type="text/javascript"> window.onload = function () { alert("Mauvais mot de passe ou email"); }
                                    </script>';
                    */
                    $email_err_mess = "Mauvais mot de passe ou email";
                }
            
        }
    }
?>
<head>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
<body>
    <div class="PCIR">
        <h2>Connexion</h2>
        <form action = "Connexion.php" method="POST">
            <input name="E-mail" type="email" placeholder="E-mail" required value="<?php echo htmlspecialchars($newemail);?>">
            <span style = "color : red">
                <?php echo $email_err_mess ?? "" ?>
            </span>
            <input name = "Password" type="password" placeholder="Password" required value="<?php echo htmlspecialchars($newmdp);?>">
                <div class="checkbox">
                <input type ="checkbox" id="check" name="checkbox">
                <label for="check">Se souvenir de moi</label>
            </div>
            <button type="submit">Connexion</button>
        </form>
        <a href="Reinitialisation.php">Mot de passe oublié ?</a>
        <div class = "link">Nouveau ici ? <a href="Inscription.php">Inscrivez vous</a>
        </div>
    </div>
</body>
</html>
<?php

?>