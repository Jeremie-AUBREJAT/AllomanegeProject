// filtre prix
document.addEventListener('DOMContentLoaded', function () {
    const priceFilter = document.getElementById('price');
    const carouselContainer = document.querySelector('.grid');  // Sélectionner le conteneur des carrousels
    const carousels = Array.from(carouselContainer.children);

    priceFilter.addEventListener('change', function () {
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

        // Vider le conteneur et ajouter les carrousels triés
        carouselContainer.innerHTML = '';
        sortedCarousels.forEach(carousel => carouselContainer.appendChild(carousel));
    });
});

//filtre categories

document.getElementById('category-filter').addEventListener('change', function() {
    var selectedCategory = this.value;
    var categories = document.getElementsByName('category');
    
    categories.forEach(function(category) {
        var carousel = category.closest('.carousel'); // Trouver l'élément parent avec la classe "carousel"
        
        if (selectedCategory === 'allcategories' || category.textContent.trim() === selectedCategory) {
            if(carousel) {
                carousel.style.display = 'block'; // Afficher la div du carrousel si la catégorie correspond
            }
        } else {
            if(carousel) {
                carousel.style.display = 'none'; // Masquer la div du carrousel si la catégorie correspond
            }
        }
    });
});

// filtre localisation
document.addEventListener('DOMContentLoaded', function() {
    // Mettre à jour la valeur de l'input range lorsqu'il est chargé
    var locationInput = document.getElementById('location');
    var locationValue = document.getElementById('locationValue');
    locationValue.innerText = locationInput.value + " km"; // Mettre à jour la valeur affichée

    // Écouteur d'événement pour mettre à jour la valeur affichée de l'input range
    locationInput.addEventListener('input', function() {
        locationValue.innerText = this.value + " km"; // Mettre à jour la valeur affichée
    });

    // Initialiser la position GPS
    getPosition();
});

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
    var distance = document.getElementById('location').value; // Obtenir la distance sélectionnée depuis l'input range

    // Récupérer tous les éléments de type "carousel"
    var carousels = document.querySelectorAll('.carousel');

    // Parcourir tous les carrousels
    carousels.forEach(function(carousel) {
        var carouselLocation = calculateDistance(carousel.dataset.latitude, carousel.dataset.longitude, position.coords.latitude, position.coords.longitude);

        // Afficher ou masquer le carousel en fonction de la distance
        if (carouselLocation <= distance) {
            carousel.style.display = 'block';
        } else {
            carousel.style.display = 'none';
        }
    });
}

// Fonction pour calculer la distance entre deux points GPS
function calculateDistance(lat1, lon1, lat2, lon2) {
    var R = 6371; // Rayon de la Terre en km
    var dLat = deg2rad(lat2 - lat1);
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance en km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180);
}

// Appeler la fonction getPosition pour obtenir la position initiale
getPosition();

// Ajouter un écouteur d'événements sur le range pour détecter les changements de valeur
document.getElementById('location').addEventListener('input', function() {
    getPosition(); // Appel de la fonction pour obtenir la position actuelle de l'utilisateur lorsque la valeur du range change
});
