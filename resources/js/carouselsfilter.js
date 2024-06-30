document.addEventListener('DOMContentLoaded', function () {
    // Variables pour les éléments DOM
    const priceFilter = document.getElementById('price');
    const categoryFilter = document.getElementById('category-filter');
    const locationInput = document.getElementById('location');
    const locationValue = document.getElementById('locationValue');
    const carouselContainer = document.querySelector('.grid');
    const carousels = Array.from(carouselContainer.children);

    // Mettre à jour la valeur de l'input range lorsqu'il est chargé
    locationValue.innerText = locationInput.value + " km";

    // Écouteur d'événement pour mettre à jour la valeur affichée de l'input range
    locationInput.addEventListener('input', function () {
        locationValue.innerText = this.value + " km"; // Mettre à jour la valeur affichée
    });

    // Nouvel écouteur d'événement pour détecter le changement de valeur du slider
    locationInput.addEventListener('change', getPosition);

    // Fonction pour filtrer par prix
    function filterByPrice() {
        carousels.forEach(carousel => {
            carousel.style.display = 'block';
        });

        const selectedOption = priceFilter.value;
        let sortedCarousels;

        if (selectedOption === 'lowToHigh') {
            sortedCarousels = carousels.sort((a, b) => {
                const priceA = parseFloat(a.querySelector('[name="price"]').textContent.replace('€', '').trim());
                const priceB = parseFloat(b.querySelector('[name="price"]').textContent.replace('€', '').trim());
                return priceA - priceB;
            });
        } else if (selectedOption === 'highToLow') {
            sortedCarousels = carousels.sort((a, b) => {
                const priceA = parseFloat(a.querySelector('[name="price"]').textContent.replace('€', '').trim());
                const priceB = parseFloat(b.querySelector('[name="price"]').textContent.replace('€', '').trim());
                return priceB - priceA;
            });
        } else {
            sortedCarousels = carousels;
        }

        carouselContainer.innerHTML = '';
        sortedCarousels.forEach(carousel => carouselContainer.appendChild(carousel));
    }

    // Fonction pour filtrer par catégorie
    function filterByCategory() {
        const selectedCategory = categoryFilter.value;
        const categories = document.getElementsByName('category');

        categories.forEach(function (category) {
            const carousel = category.closest('.carousel');
            if (selectedCategory === 'allcategories' || category.textContent.trim() === selectedCategory) {
                if (carousel) {
                    carousel.style.display = 'block';
                }
            } else {
                if (carousel) {
                    carousel.style.display = 'none';
                }
            }
        });
    }

    // Fonction pour obtenir la position GPS du navigateur
    function getPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showCarouselsWithinRange);
        } else {
            alert("La géolocalisation n'est pas supportée par votre navigateur.");
        }
    }

    // Fonction pour afficher les carrousels à la distance sélectionnée
    function showCarouselsWithinRange(position) {
        const distance = locationInput.value;

        carousels.forEach(function (carousel) {
            const carouselLocation = calculateDistance(carousel.dataset.latitude, carousel.dataset.longitude, position.coords.latitude, position.coords.longitude);

            if (carouselLocation <= distance) {
                carousel.style.display = 'block';
            } else {
                carousel.style.display = 'none';
            }
        });
    }

    // Fonction pour calculer la distance entre deux points GPS
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon1 - lon2);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const d = R * c;
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

    // Ajouter des écouteurs d'événements sur les filtres
    priceFilter.addEventListener('change', filterByPrice);
    categoryFilter.addEventListener('change', filterByCategory);
});



document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const maxPrice = parseFloat(urlParams.get('maxPrice')) || Infinity;
    const selectedCategory = urlParams.get('category');
    const nameFromURL = urlParams.get('name');
    const dateStartFromURL = urlParams.get('dateStart'); // Récupérer la date de début depuis l'URL
    const dateEndFromURL = urlParams.get('dateEnd'); // Récupérer la date de fin depuis l'URL

    // console.log('Réservation récupérée - Date de début :', dateStartFromURL);
    // console.log('Réservation récupérée - Date de fin :', dateEndFromURL);

    filterCarousels(maxPrice, selectedCategory, nameFromURL, dateStartFromURL, dateEndFromURL);
});

function filterCarousels(maxPrice, selectedCategory, nameFromURL, dateStartFromURL, dateEndFromURL) {
    const carouselContainer = document.querySelector('.grid');
    const carousels = Array.from(carouselContainer.children);

    // Convertir les dates de l'URL en objets Date
    const dateStartFromURLObj = new Date(dateStartFromURL);
    const dateEndFromURLObj = new Date(dateEndFromURL);

    carousels.forEach(carousel => {
        // Filtrer par prix
        const price = parseFloat(carousel.querySelector('[name="price"]').textContent.replace('€', '').trim());
        const priceFilter = price <= maxPrice || maxPrice === Infinity;

        // Filtrer par catégorie
        const categoryFilter = selectedCategory ? carousel.querySelector('[name="category"]').textContent.trim() === selectedCategory || selectedCategory === 'allcategories' : true;

        // Filtrer par nom
        const nameFilter = nameFromURL ? serializeString(carousel.querySelector('[name="name"]').textContent).includes(serializeString(nameFromURL)) : true;

        // Récupérer les réservations du carousel
        const reservations = carousel.querySelectorAll('.carousel-reservation');
        let notReservedInRange = true;

        reservations.forEach(reservation => {
            const dateStartCarousel = new Date(reservation.dataset.dateStart);
           

            const dateEndCarousel = new Date(reservation.dataset.dateEnd);

            // console.log('Dates de réservation du carousel :');
            // console.log('Date de début :', serializeDate(dateStartCarousel));
            // console.log('Date de fin :', serializeDate(dateEndCarousel));

            if ((dateStartFromURLObj < dateStartCarousel && dateEndFromURLObj > dateStartCarousel) || (dateStartFromURLObj < dateEndCarousel && dateEndFromURLObj > dateEndCarousel)) {
                notReservedInRange = false;
            }
        });
// console.log(notReservedInRange);
        // Afficher ou masquer le carousel en fonction des filtres
        carousel.style.display = priceFilter && categoryFilter && nameFilter && notReservedInRange ? 'block' : 'none';
    });
}

// Fonction pour sérialiser une chaîne de caractères (majuscules, sans accents, sans espaces)
function serializeString(str) {
    return str.trim().toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/\s+/g, '');
}

// Fonction pour sérialiser une date en 'YYYY-MM-DD'
function serializeDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Mois de 0 à 11, donc +1 et padStart pour avoir '01' au lieu de '1'
    const day = String(date.getDate()).padStart(2, '0'); // padStart pour avoir '01' au lieu de '1'
    return `${year}-${month}-${day}`;
}




//fonction reset filter du
document.addEventListener('DOMContentLoaded', () => {
    const resetButton = document.getElementById('reset-filters');

    // Écouteur d'événement pour réinitialiser les filtres
    resetButton.addEventListener('click', () => {
        // Appeler la fonction pour récupérer tous les manèges sans filtres
        resetFiltersAndFetchAllCarousels();
    });

    // Fonction pour effectuer la requête AJAX et récupérer tous les manèges
    function resetFiltersAndFetchAllCarousels() {
        // Construire l'URL pour récupérer tous les manèges sans filtres
        const url = `/manèges`;

        // Requête AJAX pour récupérer tous les manèges
        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Créer un document temporaire pour parser la réponse HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');

                // Extraire les sections nécessaires
                const carouselsHTML = doc.querySelector('#carousel-grid').innerHTML;
                const paginationHTML = doc.querySelector('.pagination').innerHTML;

                // Vérifiez que les éléments nécessaires sont présents dans la réponse
                if (carouselsHTML && paginationHTML) {
                    // Mettre à jour la section des manèges avec les nouvelles données
                    document.getElementById('carousel-grid').innerHTML = carouselsHTML;
                    document.querySelector('.pagination').innerHTML = paginationHTML;

                    // Réinitialiser les gestionnaires d'événements des carrousels si nécessaire
                    initializeCarouselEventHandlers();

                    // Mettre à jour l'URL dans l'historique du navigateur sans les filtres
                    history.pushState({}, '', url);
                } else {
                    console.error('Erreur: Les éléments nécessaires n\'ont pas été trouvés dans la réponse.');
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des manèges:', error);
            });
    }

    function initializeCarouselEventHandlers() {
        // Réappliquez tous les gestionnaires d'événements nécessaires pour les carrousels
    }

    // Écouteur d'événement pour le retour en arrière du navigateur
    window.addEventListener('popstate', (event) => {
        // Si l'utilisateur revient à la page des manèges sans filtres, récupérer tous les manèges
        if (window.location.pathname === '/manèges') {
            resetFiltersAndFetchAllCarousels();
        }
    });
});
