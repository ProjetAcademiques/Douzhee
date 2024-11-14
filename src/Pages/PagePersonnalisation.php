<?php
require_once ("/Utils/header.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/CSS/stylePersonnalisation.css">
</head>
<body>
    <div class="container">
        <form action="PagePersonnalisation.php" method="POST">
            <h2>Pseudo</h2>
            <input type="text" name="pseudo" required maxlength="50">
            <h2>Biographie</h2>
            <input type="text" name="biographie" required maxlength="500">
            <input type="file" name="avatar" >
            <h2>Thèmes</h2>
            <img src="images/imagepersonnalisation/themes_1.png" alt="Themes_1" width="88" height="83">
            <img src="images/imagepersonnalisation/Themes_2.png" alt="Themes_2" width="88" height="83">
            <h2>Dés</h2>

      
    </div>   
</body>
</html>