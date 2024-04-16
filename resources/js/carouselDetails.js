document.addEventListener('DOMContentLoaded', () => {
    // Récupérer les éléments DOM
    const thumbnails = document.querySelectorAll('#thumbnails img');
    const mainImage = document.querySelector('#carousel img');

    // Ajouter un écouteur d'événement à chaque miniature pour changer l'image principale
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            mainImage.src = thumbnail.src;
            mainImage.alt = thumbnail.alt;
            });
            });
        });