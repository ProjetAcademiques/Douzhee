import { changeTheme } from './scriptTheme.js';

document.addEventListener('DOMContentLoaded', function() {
    var themeSelected;
    var musicSelected;

    var pseudo = document.querySelector('#pseudoInput');
    var description = document.querySelector('#descriptionInput');

    var formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getThemeAndMusic.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            themeSelected = document.getElementById(data.theme);
            themeSelected.classList.add('selected');

            var fourthCharFromEnd = data.music.charAt(data.music.length - 5);
            musicSelected = document.getElementById(fourthCharFromEnd);
            musicSelected.classList.add('selected');
        }
    });

    var themes = document.querySelectorAll('.themeItem');
    var musics = document.querySelectorAll('.musicItem');

    themes.forEach(function(theme) {
        theme.addEventListener('click', function() {
            if (themeSelected != undefined) {
                themeSelected.classList.remove('selected');
            }
            themeSelected = theme;
            themeSelected.classList.add('selected');
            console.log(themeSelected.id);
            changeTheme(themeSelected.id + '');
        });
    });


    musics.forEach(function(music) {
        music.addEventListener('click', function() {
            if (musicSelected != undefined) {
                musicSelected.classList.remove('selected');
            }
            musicSelected = music;
            musicSelected.classList.add('selected');
        });
    });

    var saveButton = document.querySelector('#valider');
    saveButton.addEventListener('click', function() {
        var musicsPath = '../../assets/audio/MusicAccueil' + musicSelected.id + '.mp3';

        var formData = new FormData();
        formData.append('theme', themeSelected.id);
        formData.append('music', musicsPath);
        formData.append('pseudo', pseudo.value);
        formData.append('description', description.value);
        formData.append('testdesecurité', true);
        fetch('../Utils/savePersonnalisation.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '../Pages/Profil.php';
            } else {
                console.error("Erreur : " + data.message);
            }
        })

    });
});