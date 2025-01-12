document.addEventListener('DOMContentLoaded', function() {
    const containerRegle = document.querySelectorAll('.container .regle');
    const allBob = document.querySelectorAll('.bob');

    allBob.forEach(function(item) {
        item.classList.add('notSelected');
    });

    var indSelected = 0;
    allBob[indSelected].classList.remove('notSelected');
    allBob[indSelected].classList.add('selected');
    containerRegle[indSelected].classList.add('selected');
    
    var i = 0;
    containerRegle.forEach(function(item) {
        if (!(i % 2 == 0)) {
            item.classList.add('inverse');
        }
        i++;
    });

    const container = document.querySelector('.container');
    let isScrolling = false;
    
    const scrollHandler = (direction) => {
        if (!isScrolling ) {
            var oldIndSelected = indSelected;
            isScrolling = true;
            const scrollAmount = direction === 'up' 
                ? -(containerRegle[0].offsetHeight + 1)
                : containerRegle[0].offsetHeight + 1;

            if (direction === 'up') {
                indSelected = Math.max(0, indSelected - 1);
            } else {
                indSelected = Math.min(allBob.length - 1, indSelected + 1);
            }

            if ((indSelected >= 2 && direction === 'down') || (indSelected <= allBob.length - 3 && direction === 'up')) {
                container.scrollBy({
                    top: scrollAmount,
                    behavior: 'smooth'
                });
            }

            allBob[oldIndSelected].classList.remove('selected');
            allBob[oldIndSelected].classList.add('notSelected');
            containerRegle[oldIndSelected].classList.remove('selected');
            
            allBob[indSelected].classList.remove('notSelected');
            allBob[indSelected].classList.add('selected');
            containerRegle[indSelected].classList.add('selected');

            // Attendre la fin de l'animation (~300ms pour "smooth")
            setTimeout(() => {
                isScrolling = false;
            }, 300);
        }
    };

    container.addEventListener('wheel', function(event) {
        if (!event.ctrlKey) {
            event.preventDefault();

            if (event.deltaY < 0) {
                scrollHandler('up');
            }
            else {
                scrollHandler('down');
            }
        }
    }, { passive: false }); // Permet de bloquer le scroll natif

    // Code pour faire suivre les pupils à la souris
    const pupils = document.querySelectorAll('.pupil');
    document.addEventListener('mousemove', function(event) {
        const mouseX = event.clientX; // Coordonnée X de la souris
        const mouseY = event.clientY; // Coordonnée Y de la souris
 
        // Pour chaque pupil, on calcule l'angle et la distance entre la souris et le pupil
        pupils.forEach(function(pupil) {
            const rect = pupil.getBoundingClientRect(); // Récupérer les coordonnées du pupil
            const pupilX = rect.left + rect.width / 2; // Coordonnée X du centre du pupil
            const pupilY = rect.top + rect.height / 2; // Coordonnée Y du centre du pupil

            const angle = Math.atan2(mouseY - pupilY, mouseX - pupilX); // Calcul de l'angle entre la souris et le pupil
            const distance = Math.min(10, Math.hypot(mouseX - pupilX, mouseY - pupilY)); // Calcul de la distance entre la souris et le pupil

            const offsetX = Math.cos(angle) * distance; // Calcul du décalage en X
            const offsetY = Math.sin(angle) * distance; // Calcul du décalage en Y

            pupil.style.transform = `translate(${offsetX}px, ${offsetY}px)`; // Appliquer le décalage
        });
    });
});