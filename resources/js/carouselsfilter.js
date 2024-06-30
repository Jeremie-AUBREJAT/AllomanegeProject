
document.addEventListener('DOMContentLoaded', function () {
    // Variables pour les éléments DOM
    const priceFilter = document.getElementById('price');
    const categoryFilter = document.getElementById('category-filter2');
    const locationInput = document.getElementById('location');
    const locationValue = document.getElementById('locationValue');
    const carouselContainer = document.querySelector('.grid');
    const carousels = Array.from(carouselContainer.children);
    const carouselsPerPage = 4; // Nombre de carousels par page
    let currentPage = 1;
    let filteredCarousels = carousels;

    // Mettre à jour la valeur de l'input range lorsqu'il est chargé
    locationValue.innerText = locationInput.value + " km";

    // Écouteur d'événement pour mettre à jour la valeur affichée de l'input range
    locationInput.addEventListener('input', function () {
        locationValue.innerText = this.value + " km"; // Mettre à jour la valeur affichée
    });

    // Nouvel écouteur d'événement pour détecter le changement de valeur du slider
    locationInput.addEventListener('change', getPosition);

    // Fonction pour afficher les carousels pour une page donnée
    function displayCarouselsForPage(page) {
        const startIndex = (page - 1) * carouselsPerPage;
        const endIndex = page * carouselsPerPage;
        const visibleCarousels = filteredCarousels.slice(startIndex, endIndex);

        carouselContainer.innerHTML = '';
        visibleCarousels.forEach(carousel => carouselContainer.appendChild(carousel));
    }

    // Fonction pour créer les boutons de pagination
    function createPaginationButtons(totalCarousels) {
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = '';

        const totalPages = Math.ceil(totalCarousels / carouselsPerPage);

        // Bouton flèche gauche
        const prevButton = document.createElement('button');
        prevButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        `;
        prevButton.className = 'flex items-center justify-center w-10 h-10 p-2 rounded-md bg-custom-blue-header ml-2';
        prevButton.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                displayCarouselsForPage(currentPage);
                updatePaginationButtons();
            }
        });
        paginationContainer.appendChild(prevButton);

        // Boutons numéros de page
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.innerText = i.toString();
            pageButton.className = 'flex items-center justify-center w-10 h-10 p-2 rounded-md bg-custom-blue-header ml-2';
            if (i === currentPage) {
                pageButton.classList.add('text-gray-500', 'text-white','font-bold','text-xl'); // Classe pour le bouton de la page active
                pageButton.disabled = true;
            } else {
                pageButton.classList.add('text-gray-500','font-bold','text-xl'); // Couleur de texte gris-400 pour les autres boutons de page
            }
            pageButton.addEventListener('click', function () {
                currentPage = i;
                displayCarouselsForPage(currentPage);
                updatePaginationButtons();
            });
            paginationContainer.appendChild(pageButton);
        }

        // Bouton flèche droite
        const nextButton = document.createElement('button');
        nextButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        `;
        nextButton.className = 'flex items-center justify-center w-10 h-10 p-2 rounded-md bg-custom-blue-header ml-2';
        nextButton.addEventListener('click', function () {
            if (currentPage < totalPages) {
                currentPage++;
                displayCarouselsForPage(currentPage);
                updatePaginationButtons();
            }
        });
        paginationContainer.appendChild(nextButton);
    }

    // Fonction pour mettre à jour les boutons de pagination après changement de page
    function updatePaginationButtons() {
        const paginationButtons = document.querySelectorAll('.pagination button');
        paginationButtons.forEach(button => {
            if (parseInt(button.innerText) === currentPage) {
                button.classList.add('bg-gray-300', 'text-white');
                button.disabled = true;
            } else {
                button.classList.remove('bg-gray-300', 'text-white');
                button.disabled = false;
            }
        });
    }

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
        const R = 6371; // Rayon de la Terre en km
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

    // Fonction pour appliquer tous les filtres et mettre à jour la pagination
    function applyFilters() {
        filterByPrice();
        filterByCategory();
        getPosition();
        
        // Filtrer les carousels visibles
        filteredCarousels = carousels.filter(carousel => carousel.style.display !== 'none');
        
        const totalVisibleCarousels = filteredCarousels.length;
        createPaginationButtons(totalVisibleCarousels);
        displayCarouselsForPage(currentPage); // Afficher la première page après le filtrage
        updatePaginationButtons(); // Mettre à jour les boutons de pagination
    }

    // Ajouter les écouteurs d'événements sur les filtres
    priceFilter.addEventListener('change', applyFilters);
    categoryFilter.addEventListener('change', applyFilters);
    locationInput.addEventListener('change', applyFilters);

    // Appliquer les filtres au chargement de la page
    applyFilters();
});




//fonction reset filter du
// document.addEventListener('DOMContentLoaded', () => {
//     const resetButton = document.getElementById('reset-filters');

//     // Écouteur d'événement pour réinitialiser les filtres
//     resetButton.addEventListener('click', () => {
//         // Appeler la fonction pour récupérer tous les manèges sans filtres
//         resetFiltersAndFetchAllCarousels();
//     });

//     // Fonction pour effectuer la requête AJAX et récupérer tous les manèges
//     function resetFiltersAndFetchAllCarousels() {
//         // Construire l'URL pour récupérer tous les manèges sans filtres
//         const url = `/manèges`;

//         // Requête AJAX pour récupérer tous les manèges
//         fetch(url)
//             .then(response => response.text())
//             .then(data => {
//                 // Créer un document temporaire pour parser la réponse HTML
//                 const parser = new DOMParser();
//                 const doc = parser.parseFromString(data, 'text/html');

//                 // Extraire les sections nécessaires
//                 const carouselsHTML = doc.querySelector('#carousel-grid').innerHTML;
//                 const paginationHTML = doc.querySelector('.pagination').innerHTML;

//                 // Vérifiez que les éléments nécessaires sont présents dans la réponse
//                 if (carouselsHTML && paginationHTML) {
//                     // Mettre à jour la section des manèges avec les nouvelles données
//                     document.getElementById('carousel-grid').innerHTML = carouselsHTML;
//                     document.querySelector('.pagination').innerHTML = paginationHTML;

//                     // Réinitialiser les gestionnaires d'événements des carrousels si nécessaire
//                     initializeCarouselEventHandlers();

//                     // Mettre à jour l'URL dans l'historique du navigateur sans les filtres
//                     history.pushState({}, '', url);
//                 } else {
//                     console.error('Erreur: Les éléments nécessaires n\'ont pas été trouvés dans la réponse.');
//                 }
//             })
//             .catch(error => {
//                 console.error('Erreur lors de la récupération des manèges:', error);
//             });
//     }

//     function initializeCarouselEventHandlers() {
//         // Réappliquez tous les gestionnaires d'événements nécessaires pour les carrousels
//     }

//     // Écouteur d'événement pour le retour en arrière du navigateur
//     window.addEventListener('popstate', (event) => {
//         // Si l'utilisateur revient à la page des manèges sans filtres, récupérer tous les manèges
//         if (window.location.pathname === '/manèges') {
//             resetFiltersAndFetchAllCarousels();
//         }
//     });
// });
