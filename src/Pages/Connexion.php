<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    $cookiename = "Email";
    $cookiename2 = "Password";
?>

    <link rel="stylesheet" href="../../assets/css/styleCIRV.css"> 
</head>
<body>
    <div class="PCIR">
        <h2>Connexion</h2>
        <form action = "Connexion.php" method="POST">
            <input name="E-mail" type="email" placeholder="E-mail" required value="<?php echo $_COOKIE[$cookiename] ?? '';?>">
            <input name = "Password" type="password" placeholder="Password" required value="<?php echo $_COOKIE[$cookiename2] ?? '';?>">
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
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['E-mail']) && !empty($_POST['Password'])){
        $email = $_POST['E-mail'];
        $mdp = $_POST['Password'];
        if (!empty($_POST['checkbox'])){
            $cookievalue = $email;
            $cookievalue2 = $mdp;
            setcookie($cookiename,$cookievalue,time() + (60*60*3),"/");
            setcookie($cookiename2,$cookievalue2,time() + (60*60*2),"/");
        }else{
            setcookie($cookiename,"",time() - 9600,"/");
            setcookie($cookiename2,"",time() - 9600, "/");
        }
        $trouve = verifUser($_POST['E-mail'],$_POST['Password']);
        if ($trouve){
            $_SESSION['userId'] = getIdUser($_POST['E-mail']);
            $_SESSION['timeStart'] = microtime(true); 
            header('Location: Index.php');
            exit;
        } else {
            echo '<script 
                        type="text/javascript"> window.onload = function () { alert("Mauvais mot de passe ou email"); }
                        </script>';
        }
    }
}
?>