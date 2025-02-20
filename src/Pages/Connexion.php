<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    $cookiename = "Email";
    $cookiename2 = "Password";
    $key = "this-is-a-zikette-key-for-a-pass";
    $newemail = isset($_COOKIE[$cookiename]) ? decryptage($_COOKIE[$cookiename], $key) : '';
    $newmdp = isset($_COOKIE[$cookiename2]) ? decryptage($_COOKIE[$cookiename2], $key) : '';
?>
<head>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
<body>
    <div class="PCIR">
        <h2>Connexion</h2>
        <form id="loginForm" method="POST">
            <input id="E-mail" type="email" placeholder="E-mail" required value="<?php echo htmlspecialchars($newemail);?>">
            <span style = "color : red">
            </span>
            <input id = "Password" type="password" placeholder="Password" required value="<?php echo htmlspecialchars($newmdp);?>">
                <div class="checkbox">
                <input type ="checkbox" id="check" name="checkbox">
                <label for="check">Se souvenir de moi</label>
            </div>
            <button type="submit">Connexion</button>
        </form>
        <a href="Reinitialisation.php">Mot de passe oublié ?</a>
        <div class = "link">
            Nouveau ici ? 
            <a href="Inscription.php">Inscrivez vous</a>
        </div>
    </div>
    <script src="../../assets/js/auth.js"></script>
</body>
</html>
