document.addEventListener('DOMContentLoaded', function() {
    const audio = document.getElementById("audioSource");

    // Fetch the music path from the server
    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/processusGetMusicPath.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.musicPath) {
            audio.src = data.musicPath;
            audio.addEventListener('canplaythrough', function() {
                if (localStorage.getItem('isMusicPlaying') === 'true' ) {
                    audio.play(); 
                } else {
                    audio.pause();
                }
                var currentTime = localStorage.getItem('audioCurrentTime');
                if (currentTime) {
                    audio.currentTime = currentTime;
                }

                audio.style.display = 'none';
            });
        } else {
            console.error('Music path not found');
        }
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
    });
    window.addEventListener('beforeunload', function() {
        if (!audio.paused) {
            localStorage.setItem('isMusicPlaying', 'true');
        } else {
            localStorage.setItem('isMusicPlaying', 'false');
        }
        localStorage.setItem('audioCurrentTime', audio.currentTime);
    });
    
    window.addEventListener('beforeunload', function() {
    if (!audio.paused) {
        localStorage.setItem('isMusicPlaying', 'true');
    } else {
        localStorage.setItem('isMusicPlaying', 'false');
    }
    localStorage.setItem('audioCurrentTime', audio.currentTime);
});

    
});
