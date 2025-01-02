var regles = document.querySelector('#regles');
var spanRegles = document.querySelector('#regles span');
var imgRegles = document.querySelector('#regles img');
var boolRegle = true;

var classement = document.querySelector('#classement');
var spanClassement = document.querySelector('#classement span');
var imgClassement = document.querySelector('#classement img');
var boolClassement = true;

regles.addEventListener('mouseover', function() {
    if (boolRegle) {
        spanRegles.classList.add('animateLeft');
        imgRegles.classList.add('animateRight');
        //regles.classList.add('animateZoomIn');
    }
});

regles.addEventListener('animationend', function() {
    spanRegles.classList.remove('animateLeft');
    imgRegles.classList.remove('animateRight');
    //regles.classList.remove('animateZoomIn');
    boolRegle = false;
});

regles.addEventListener('mouseleave', function() {
    boolRegle = true;
});


classement.addEventListener('mouseover', function() {
    if (boolClassement) {
        spanClassement.classList.add('animateLeft');
        imgClassement.classList.add('animateRight');
        //classement.classList.add('animateZoomIn');
    }
});

classement.addEventListener('animationend', function() {
    spanClassement.classList.remove('animateLeft');
    imgClassement.classList.remove('animateRight');
    //classement.classList.remove('animateZoomIn');
    boolClassement = false;
});

classement.addEventListener('mouseleave', function() {
    boolClassement = true;
});