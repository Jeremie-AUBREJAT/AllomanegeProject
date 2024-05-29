document.addEventListener('DOMContentLoaded', () => {
    const carouselDiv = document.querySelector('#carousel'); // Sélection de la div du carrousel
    const fullScreenDiv = document.querySelector('#fullScreenImage'); // Sélection de la div pour l'affichage en plein écran
    const fullScreenImage = document.createElement('img'); // Création de l'image dans la div en plein écran
    const thumbnails = document.querySelectorAll('#thumbnails img'); // Sélection de toutes les miniatures
    const prevButton = document.createElement('button'); // Création du bouton précédent
    const nextButton = document.createElement('button'); // Création du bouton suivant
    let currentIndex = 0; // Index de l'image actuellement affichée

    // Styling des boutons
    prevButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></svg>';
    prevButton.style.position = 'absolute';
    prevButton.style.top = '50%';
    prevButton.style.left = '10px';
    prevButton.style.transform = 'translateY(-50%)';
    prevButton.style.backgroundColor = '#01105a'; // Fond bleu
    prevButton.style.color = 'white'; // Texte blanc
    prevButton.style.padding = '10px 20px'; // Padding plus grand
    prevButton.style.borderRadius = '20px'; // Bordure arrondie
    nextButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg>';
    nextButton.style.position = 'absolute';
    nextButton.style.top = '50%';
    nextButton.style.right = '10px';
    nextButton.style.transform = 'translateY(-50%)';
    nextButton.style.backgroundColor = '#01105a'; // Fond bleu
    nextButton.style.color = 'white'; // Texte blanc
    nextButton.style.padding = '10px 20px'; // Padding plus grand
    nextButton.style.borderRadius = '50px'; // Bordure arrondie

    // Fonction pour afficher l'image en plein écran avec un index donné
    function showFullScreenImage(index) {
        currentIndex = index; // Mettre à jour l'index de l'image actuellement affichée

        // Mettre à jour l'image en plein écran avec l'image correspondante
        if (index === 0) {
            const mainImage = carouselDiv.querySelector('img');
            fullScreenImage.src = mainImage.src;
            fullScreenImage.alt = mainImage.alt;
        } else {
            const selectedThumbnail = thumbnails[currentIndex - 1];
            fullScreenImage.src = selectedThumbnail.src;
            fullScreenImage.alt = selectedThumbnail.alt;
        }
        
        // Affiche l'élément en plein écran
        fullScreenDiv.innerHTML = ''; // Efface le contenu précédent
        fullScreenDiv.appendChild(fullScreenImage);
        fullScreenDiv.appendChild(prevButton);
        fullScreenDiv.appendChild(nextButton);
        fullScreenDiv.classList.remove('hidden');

        // Ajouter un écouteur d'événement au clic sur l'image en plein écran pour fermer le carrousel
        fullScreenImage.addEventListener('click', closeCarousel);
    }

    // Fonction pour fermer le carrousel
    function closeCarousel() {
        fullScreenDiv.classList.add('hidden'); // Cacher le carrousel
        // Retirer l'écouteur d'événement du clic sur l'image en plein écran
        fullScreenImage.removeEventListener('click', closeCarousel);
    }

    // Ajout d'un écouteur d'événement au clic sur la div du carrousel
    carouselDiv.addEventListener('click', () => {
        // Afficher la première image en plein écran
        showFullScreenImage(0);

        // Ajouter les écouteurs d'événements pour les boutons précédent et suivant
        prevButton.addEventListener('click', showPrevImage);
        nextButton.addEventListener('click', showNextImage);
    });

    // Fonction pour afficher l'image suivante en plein écran
    function showNextImage() {
        currentIndex = (currentIndex + 1) % (thumbnails.length + 1); // Incrémenter l'index en boucle
        showFullScreenImage(currentIndex);
    }

    // Fonction pour afficher l'image précédente en plein écran
    function showPrevImage() {
        currentIndex = (currentIndex - 1 + thumbnails.length + 1) % (thumbnails.length + 1); // Décrémenter l'index en boucle
        showFullScreenImage(currentIndex);
    }
});

