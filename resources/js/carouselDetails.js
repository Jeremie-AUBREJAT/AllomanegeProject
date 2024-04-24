document.addEventListener('DOMContentLoaded', () => {
        // Récupérer les éléments DOM
        const thumbnails = document.querySelectorAll('#thumbnails img');
        const mainImage = document.querySelector('#carousel img');

        // Ajouter un écouteur d'événement à chaque miniature pour changer l'image principale
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                // Récupérer l'image principale actuelle
                const tempImageSrc = mainImage.src;
                const tempImageAlt = mainImage.alt;

                // Mettre à jour l'image principale avec celle de la miniature
                mainImage.src = thumbnail.src;
                mainImage.alt = thumbnail.alt;

                // Mettre à jour la miniature avec l'ancienne image principale
                thumbnail.src = tempImageSrc;
                thumbnail.alt = tempImageAlt;
            });
        });
    });
