document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('audioPlayer');
    const audioSource = document.getElementById("audioSource");

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

    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/isConnected.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            localStorage.setItem("isMusicPlaying", "true");
            audio.play();
        } else if (data.status === 'unsucess') {
            localStorage.setItem("isMusicPlaying", "false");
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération de la connexion:', error);
    });

    async function updateMusicPath() {
        try {
            const response = await fetch('../Utils/processusGetMusicPath.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            let basePath = "../../assets/audio/";
            let fileName = audioSource.src.split('/').pop();
            let newaudioSource = basePath + fileName;
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
});