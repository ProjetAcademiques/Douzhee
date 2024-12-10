<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
    <div class="PCIR">
        <h2>Saisir le code</h2>
        <form action = "Verification.php" method="POST" >
            <input name="codeVerification" type="text" placeholder="Code de vérification" required >
            <button type="submit">Valider le code</button>
        </form>
    </div>
</body>
</html>
<?php

    if (!empty($_POST['codeVerification'])){
        echo $_SESSION['codeVerification'];
        if ($_POST['codeVerification'] == $_SESSION['codeVerification']){
            updatePassword($_SESSION['newPassword'],$_SESSION['E-mail']);
            unset($_SESSION['codeVerification']);
            header('Location: Connexion.php');
        }else{
            echo '<script 
            type="text/javascript"> window.onload = function () { alert("Mauvais code de verification"); }
            </script>';
        }
    }
?>