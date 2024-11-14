<?php
require_once("header.php");
?>
<!DOCTYPE html>
<html lang ="fr">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page des règles</title>
        <link rel="stylesheet" href="style_regles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    </head>
    <body>
         <div class="container">
            <div class="bulle" id="bulle">
                <p id="Texte">Première fois ici? Voulez-vous que je vous explique les règles?</p>
                <div class="Bouton">
                    <button type="button" id="Valider">Oui</button>
                    <button type="button" id="Refuser">Non</button>
                    <audio id="audio" src="audio/musique.mp3"></audio>
                    <img src="img/fleche.png" alt="fleche" id="flèche" width="60" height="30 ">
                </div>
            </div>
            <img src="img/mascotte1.png" alt="Personnage" id="FirstMascotte" width="200" height="300">
            <img src="img/mascotte2.png" alt="Personnage" id="SecondMascotte" width="200" height="300">  
        </div>
        <script src="script.js"></script>
    </body>
</html>