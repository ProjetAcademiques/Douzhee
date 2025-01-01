var regles = document.querySelector('#regles');
var spanRegles = document.querySelector('#regles span');
var imgRegles = document.querySelector('#regles img');
var bool = true;

regles.addEventListener('mouseover', function() {
    if (bool) {
        spanRegles.classList.add('animateLeft');
        imgRegles.classList.add('animateRight');
    }
});

regles.addEventListener('animationend', function() {
    spanRegles.classList.remove('animateLeft');
    imgRegles.classList.remove('animateRight');
    bool = false;
});

regles.addEventListener('mouseleave', function() {
    bool = true;
});