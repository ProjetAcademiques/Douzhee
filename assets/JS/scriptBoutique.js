document.addEventListener('DOMContentLoaded', function() {
    const containers = document.querySelectorAll('.store');
    const navUp = document.querySelector('#navUp');
    const navDown = document.querySelector('#navDown');

    var indexSelected = 0;

    function allInvisible() {
        containers.forEach(function(container) {
            container.classList.add('notSelected');
        });
    }

    function selectContainer(index) {
        containers[index].classList.remove('notSelected');
    }

    function toggleNav(index) {
        if (index === 0) {
            navUp.classList.add('invisible');
            navDown.classList.remove('invisible');
        }
        else if (index === containers.length - 1) {
            navUp.classList.remove('invisible');
            navDown.classList.add('invisible');
        }
        else {
            navUp.classList.remove('invisible');
            navDown.classList.remove('invisible');
        }
    }
    
    function moveDown() {
        navUp.classList.add('animateFadeZoomOut');
        navDown.classList.add('animateFadeZoomOut');

        oldIndex = indexSelected;
        containers[indexSelected].classList.add('animateFadeOutUp');
        containers[oldIndex].addEventListener('animationend', function() {
            containers[oldIndex].classList.remove('animateFadeOutUp');
            containers[oldIndex].classList.add('notSelected');
        }); {once : true} 

        indexSelected++;
        
        selectContainer(indexSelected);
        containers[indexSelected].classList.add('animateFadeInUp');
        containers[indexSelected].addEventListener('animationend', function() {
            containers[indexSelected].classList.remove('animateFadeInUp');
            
            navUp.classList.remove('animateFadeZoomOut');
            navDown.classList.remove('animateFadeZoomOut');

            navUp.classList.add('animateFadeZoomIn');
            navDown.classList.add('animateFadeZoomIn');

            toggleNav(indexSelected);
        }); {once : true}
    }

    function moveUp() {
        navUp.classList.add('animateFadeZoomOut');
        navDown.classList.add('animateFadeZoomOut');

        oldIndex = indexSelected;
        containers[indexSelected].classList.add('animateFadeOutDown');
        containers[oldIndex].addEventListener('animationend', function() {
            containers[oldIndex].classList.remove('animateFadeOutDown');
            containers[oldIndex].classList.add('notSelected');
        }); {once : true}

        indexSelected--;

        selectContainer(indexSelected);
        containers[indexSelected].classList.add('animateFadeInDown');
        containers[indexSelected].addEventListener('animationend', function() {
            containers[indexSelected].classList.remove('animateFadeInDown');

            navUp.classList.remove('animateFadeZoomOut');
            navDown.classList.remove('animateFadeZoomOut');

            navUp.classList.add('animateFadeZoomIn');
            navDown.classList.add('animateFadeZoomIn');

            toggleNav(indexSelected);
        }); {once : true}
    }


    navDown.addEventListener('click', moveDown);
    navUp.addEventListener('click', moveUp);

    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowDown') {
            moveDown();
        } else if (event.key === 'ArrowUp') {
            moveUp();
        }
    });

    allInvisible();
    selectContainer(indexSelected);
    toggleNav(indexSelected);
});