import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Fonction pour centrer la carte sur la position de l'utilisateur et ajouter un marqueur à sa position
function centerMapOnUser(latitude, longitude, map) {
    // Vérifier si la géolocalisation est disponible dans le navigateur
    if ("geolocation" in navigator) {
        // Demander la position de l'utilisateur
        navigator.geolocation.getCurrentPosition(function(position) {
            // Récupérer les coordonnées de la position de l'utilisateur
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;

            // Créer un marqueur pour la position de l'utilisateur
            const userMarker = L.marker([userLatitude, userLongitude]).addTo(map);
            
            // Ajouter une popup au marqueur de l'utilisateur
            userMarker.bindPopup('Vous êtes ici !').openPopup();

            // Créer un marqueur personnalisé pour le carrousel
            const carouselIcon = L.icon({
                iconUrl: '/images/logo.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            // Créer un marqueur pour le carrousel avec l'icône personnalisée
            const carouselMarker = L.marker([latitude, longitude], { icon: carouselIcon }).addTo(map);
            
            // Ajouter une popup au marqueur du carrousel
            carouselMarker.bindPopup('Emplacement du carrousel').openPopup();

            // Créer un groupe de marqueurs pour centrer la carte sur la position de l'utilisateur et la position du carrousel
            const markers = L.featureGroup([userMarker, carouselMarker]);

            // Centrer la carte sur le groupe de marqueurs avec un dézoom supplémentaire
            map.fitBounds(markers.getBounds(), { padding: [75, 75], maxZoom: 12 });
        }, function(error) {
            // En cas d'erreur lors de la récupération de la position de l'utilisateur
            console.error('Erreur de géolocalisation : ', error);
        });
    } else {
        // Si la géolocalisation n'est pas disponible dans le navigateur
        console.error('La géolocalisation n\'est pas disponible dans ce navigateur.');
    }
}

// Initialiser la carte avec une vue par défaut
const map = L.map('map').setView([48.8534, 2.3488], 10); // Zoom plus bas

// Ajouter la couche de tuiles OpenStreetMap à la carte
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Récupérer les données de carrousel et de catégories depuis les attributs data
const carouselDataElement = document.getElementById('carousel-data');
const carouselDataJson = atob(carouselDataElement.dataset.carousel);
const carouselData = JSON.parse(carouselDataJson);

// Création du marqueur pour le carrousel
const { latitude, longitude, name, description } = carouselData;

// Appeler la fonction pour centrer la carte sur la position de l'utilisateur et la position du carrousel
centerMapOnUser(latitude, longitude, map);

// Forcer le redimensionnement de la carte après l'initialisation
setTimeout(function() {
    map.invalidateSize();
}, 500);

// Ajouter un écouteur d'événement pour invalider la taille de la carte lors du redimensionnement de la fenêtre
window.addEventListener('resize', function() {
    map.invalidateSize();
});
