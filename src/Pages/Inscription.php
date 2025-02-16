<?php
    require_once("../Utils/headerInit.php");
    ?>
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
</head>
    <div class="PCIR">
        <h2>Inscription</h2>
        <form id="signupForm" method="POST">
            <input id="signupEmail" type="email" placeholder="E-mail" required>
            <input id="signupPseudo" type="text" placeholder="Username" required maxlength="30" title="Longueur maximale 30 caractère!">
            <input id="signupPassword" type="password" placeholder="Password" required minlength="8" maxlength="25" title="Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.Longeur minimale 8 caractère.Longueur maximale 25 caractère!"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}">
            <span id="eye-icon" class="eye-icon">👁️</span> 
            <span id="passwordStrength" class="password-strength"></span>
            <button type="submit">Inscription</button>
        </form>
    </div>
    <script src="../../assets/js/auth.js"></script>
</body>
</html>
