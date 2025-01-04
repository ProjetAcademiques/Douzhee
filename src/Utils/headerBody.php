<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDSkinAchete.php");
if (isset($_SESSION['userId'])){
    $allAchats = readAllAchatByUser($_SESSION['userId']);
    $musicPath = readMusicPath($_SESSION['userId']);
}

?>
<body>
    <header>
        <audio id="audioPlayer" controls loop>
            <source id="audioSource" src="<?php echo $musicPath?>" type="audio/mpeg">
        </audio>
        <script>
          var audio = document.getElementById('audioPlayer');
          const audioSource =document.getElementById("audioSource");
          if (localStorage.getItem('isMusicPlaying') === 'true') {
                audio.play();
            } else {
                audio.pause();
            }
            var currentTime = localStorage.getItem('audioCurrentTime');
            if (currentTime) {
                audio.currentTime = currentTime;  
            }
        audio.style.display = 'none';
        window.addEventListener('beforeunload', function() {
            if (!audio.paused) {
                localStorage.setItem('isMusicPlaying', 'true'); 
            } else {
                localStorage.setItem('isMusicPlaying', 'false'); 
            }
            localStorage.setItem('audioCurrentTime', audio.currentTime);
        });
        <?php
          if (isset($_SESSION['isconnected'])){
            echo 'localStorage.setItem("isMusicPlaying", "true");';
            echo 'audio.play();';
            unset($_SESSION['isconnected']);
        }else{
            echo 'localStorage.setItem("isMusicPlaying", "false");';
        }
          ?>
          async function updateMusicPath(){
            try{
                const response = await fetch('../Utils/processusGetMusicPath.php');
                const data = await response.json();
                let basePath = "../../assets/images/musiqueBoutique/";
                let fileName = audioSource.src.split('/').pop();
                let newaudioSource = basePath +fileName;
                if (data.musicPath != newaudioSource) {
                    audioSource.src = data.musicPath;
                    audio.load();
                    audio.addEventListener('canplaythrough', () => {
                    audio.play().catch(error => {
                       console.error('Erreur lors de la lecture de la musique:', error);
                });
            });
                }
            } catch (error) {
                console.error('Erreur lors de la mise à jour de la musique:', error);
            }
            }
            updateMusicPath();
            setInterval(updateMusicPath, 60000); 
        
        </script>
        <a href="index.php">
            <input id="Logo" type="submit" value=""> 
        </a>
        
        <?php if (isset($_SESSION['userId'])):
            // On vérifie si les variables de session sont définies
            if (!isset($_SESSION['douzeCoin'])){
                $_SESSION['douzeCoin'] = getMoneyById($_SESSION['userId']); // Pour éviter de faire des requêtes inutiles
            }
            if (!isset($_SESSION['pseudo'])){
                $_SESSION['pseudo'] = getPseudoById($_SESSION['userId'])['pseudonyme']; // Pour éviter de faire des requêtes inutiles;
            }
        ?>
            <div class="selection_droite">
            <span id="money"><?php echo getMoneyById($_SESSION['userId']); ?></span>
                <img src="../../assets/images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo getPseudoById($_SESSION['userId'])['pseudonyme']; ?></span>
                <form action="Profil.php" method="GET">
                    <input id="profil" type="submit" value="">
                </form>
                <form action="Boutique.php" method="POST">
                    <button type="submit">Boutique</button>
                </form>
                <form method="POST" action="../Utils/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        <?php else: ?>
            <div class="selection_droite">
                <form method="POST" action="Connexion.php">
                    <button type="submit">Connexion</button>
                </form>
            </div>
        <?php endif; ?>
     </header>
     <?php if (isset($_SESSION['userId'])): ?>
     <script>
        const img = document.getElementById("profil")
        img.style.backgroundImage = 'url("<?php echo readAvatarById($_SESSION['userId']); ?>")'
    </script>
    <?php endif; ?>
    <!-- Je ferai ça avec un Fetch plus tard -->
    <?php
        if (isset($allAchats) && is_array($allAchats)  ){
            foreach($allAchats as $achats){
                $themeId = $achats['idSkin'];
                $etatSkin = $achats['etatSkin'];
                $typeSkin = $achats['typeSkin'];
                if ($typeSkin == "Theme" && $etatSkin == 1){
                    switch($themeId){
                        case 1:
                            ?>
                            <script>
                                document.body.style.background = "linear-gradient(to bottom, #642581 0%, #421956 52%, #421956 70%, #421956 79%, #391549 88%, #341343 95%, #341343 96%, #351444 100%, #15081B 100% )";
                                document.querySelector("header").style.backgroundColor = "#401753";
                            </script>
                            <?php
                            break;
                        case 2:
                            ?>
                            <script>
                                document.body.style.background = "linear-gradient(to bottom, #2a7d2e 0%,  #1e5d1c 52%,  #1e5d1c 70%,  #1e5d1c 79%,  #164017 88%,  #133514 95%,  #133514 96%, #143516 100%, #0d1f0f 100%)";
                                document.querySelector("header").style.backgroundColor = "#195426";
                            </script>
                            <?php
                            break;
                        case 3:
                            ?>
                            <script>
                            document.body.style.background = "linear-gradient(to bottom, #A52A2A 0%, #6F4F4F 100%)";
                            document.querySelector("header").style.backgroundColor = "#6f4b4d";
                            </script>
                            <?php
                            break;
                        case 4:
                            ?>
                            <script>
                               document.body.style.background = "linear-gradient(to bottom, #4a90e2 0%, #4285f4 25%, #3a78db 50%, #3367d6 75%, #2a56c6 100%)";
                               document.querySelector("header").style.backgroundColor = "#2c5aa0";
                            </script>
                            <?php
                            break;
                    }
                }
                
            }
        }
    ?>
