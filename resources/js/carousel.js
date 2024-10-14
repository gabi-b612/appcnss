
document.addEventListener('DOMContentLoaded', function () {
    let carousel = document.getElementById('carousel');
    let slides = carousel.children;
    let totalSlides = slides.length;
    let index = 0;

    function showSlide(i) {
        // Transition des images
        carousel.style.transform = `translateX(${-i * 100}%)`;

        // Réinitialiser l'opacité des textes
        for (let slide of slides) {
            slide.querySelectorAll('.animate-slide-in-up').forEach(textElement => {
                textElement.style.opacity = '1';
                textElement.style.transform = 'translateY(100%)';
            });
        }

        // Animer le texte du slide actuel
        setTimeout(() => {
            slides[i].querySelectorAll('.animate-slide-in-up').forEach(textElement => {
                textElement.style.opacity = '0';
                textElement.style.transform = 'translateY(0)';
            });
        }, 400); // L'animation commence après un court délai
    }

    function nextSlide() {
        index = (index + 1) % totalSlides;
        showSlide(index);
    }

    setInterval(nextSlide, 5000); // Changer de slide toutes les 5 secondes

    // Initialiser le premier slide
    showSlide(index);
});

