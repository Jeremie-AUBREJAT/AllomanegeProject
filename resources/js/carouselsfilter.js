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
        getPosition(); // Appel de la fonction pour obtenir la position actuelle de l'utilisateur lorsque la valeur du range change
    });

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


// fonction du home par recherche
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const maxPrice = parseFloat(urlParams.get('maxPrice')) || Infinity;
    const selectedCategory = urlParams.get('category');
    const nameFromURL = urlParams.get('name');

    filterCarousels(maxPrice, selectedCategory, nameFromURL);
});

function filterCarousels(maxPrice, selectedCategory, nameFromURL) {
    const carouselContainer = document.querySelector('.grid');
    const carousels = Array.from(carouselContainer.children);

    carousels.forEach(carousel => {
        // Filtrer par prix
        const price = parseFloat(carousel.querySelector('[name="price"]').textContent.replace('€', '').trim());
        const priceFilter = price <= maxPrice || maxPrice === Infinity;

        // Filtrer par catégorie
        const categoryFilter = selectedCategory ? carousel.querySelector('[name="category"]').textContent.trim() === selectedCategory || selectedCategory === 'allcategories' : true;

        // Filtrer par nom
        const nameFilter = nameFromURL ? serializeString(carousel.querySelector('[name="name"]').textContent).includes(serializeString(nameFromURL)) : true;

        // Afficher ou masquer le carousel en fonction des filtres
        carousel.style.display = priceFilter && categoryFilter && nameFilter ? 'block' : 'none';
    });
}

// Fonction pour sérialiser une chaîne de caractères (majuscules, sans accents, sans espaces)
function serializeString(str) {
    return str.trim().toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/\s+/g, '');
}

