var tempsRestant = document.querySelector('#tempsRestant');
var delet = false;

function getTimeUntilNextSundayMidnight() {
    var now = new Date();
    var nextSunday = new Date();

    nextSunday.setDate(now.getDate() + (7 - now.getDay()) % 7);
    nextSunday.setHours(24, 0, 0, 0);

    var diff = nextSunday - now;

    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
    diff -= days * (1000 * 60 * 60 * 24);

    var hours = Math.floor(diff / (1000 * 60 * 60));
    diff -= hours * (1000 * 60 * 60);

    var minutes = Math.floor(diff / (1000 * 60));
    diff -= minutes * (1000 * 60);

    var seconds = Math.floor(diff / 1000);
    
    if (days == 2 && hours == 0 && minutes == 39 && seconds == 55) {
        delet = true;
    }

    return `${days}j ${hours}h ${minutes}m ${seconds}s`;
}

function updateTimer() {
    tempsRestant.textContent = getTimeUntilNextSundayMidnight();
}

function checkAndDeleteDefis() {
    if (delet) {
        console.log("Deleting defis");
        fetch('../../src/Utils/defisDelete.php')
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        delet = false;
        location.reload();
    }
    else {
        console.log("Defis not deleted");
    }
}

console.log("Script loaded");

setInterval(checkAndDeleteDefis, 1000);
setInterval(updateTimer, 1000);

checkAndDeleteDefis();
updateTimer();