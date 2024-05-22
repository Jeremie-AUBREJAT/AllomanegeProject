import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Initialiser la carte avec une vue par défaut
const map = L.map('map').setView([51.505, -0.09], 13);

// Ajouter la couche de tuiles OpenStreetMap à la carte
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Fonction pour centrer la carte sur la position de l'utilisateur
function centerMapOnUser() {
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            // Centrer la carte sur la position de l'utilisateur
            map.setView([userLat, userLng], 13);

            // Ajouter un marqueur à la position de l'utilisateur
            L.marker([userLat, userLng]).addTo(map)
                .bindPopup('Vous êtes ici !')
                .openPopup();
        }, function(error) {
            console.error('Erreur lors de la récupération de la position : ', error);
        });
    } else {
        console.error('La géolocalisation n\'est pas prise en charge par ce navigateur.');
    }
}

// Appeler la fonction pour centrer la carte sur la position de l'utilisateur
centerMapOnUser();

// Forcer le redimensionnement de la carte après l'initialisation
setTimeout(function() {
    map.invalidateSize();
}, 1000);

// Ajouter un écouteur d'événement pour invalider la taille de la carte lors du redimensionnement de la fenêtre
window.addEventListener('resize', function() {
    map.invalidateSize();
});

