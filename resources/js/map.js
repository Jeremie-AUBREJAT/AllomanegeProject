import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// function centerMapOnUser(latitude, longitude, map) {
//     // Vérifier si la géolocalisation est activée dans le localStorage
//     if (localStorage.getItem('geolocationEnabled') === 'true') {
//         if ("geolocation" in navigator) {
//             // Demander la position de l'utilisateur
//             navigator.geolocation.getCurrentPosition(function (position) {
//                 // Récupérer les coordonnées de la position de l'utilisateur
//                 const userLatitude = position.coords.latitude;
//                 const userLongitude = position.coords.longitude;

//                 // Créer un marqueur pour la position de l'utilisateur
//                 const userMarker = L.marker([userLatitude, userLongitude]).addTo(map);

//                 // Ajouter une popup au marqueur de l'utilisateur
//                 userMarker.bindPopup('Vous êtes ici !').openPopup();

//                 // Créer un marqueur personnalisé pour le carrousel
//                 const carouselIcon = L.icon({
//                     iconUrl: '/images/logo.png',
//                     iconSize: [32, 32],
//                     iconAnchor: [16, 32],
//                     popupAnchor: [0, -32]
//                 });

//                 // Créer un marqueur pour le carrousel avec l'icône personnalisée
//                 const carouselMarker = L.marker([latitude, longitude], { icon: carouselIcon }).addTo(map);

//                 // Ajouter une popup au marqueur du carrousel
//                 carouselMarker.bindPopup('Emplacement du carrousel').openPopup();

//                 // Créer un groupe de marqueurs pour centrer la carte sur la position de l'utilisateur et la position du carrousel
//                 const markers = L.featureGroup([userMarker, carouselMarker]);

//                 // Centrer la carte sur le groupe de marqueurs avec un dézoom supplémentaire
//                 map.fitBounds(markers.getBounds(), { padding: [75, 75], maxZoom: 12 });
//             }, function (error) {
//                 // En cas d'erreur lors de la récupération de la position de l'utilisateur
//                 console.error('Erreur de géolocalisation : ', error);
//             });
//         } else {
//             // Si la géolocalisation n'est pas disponible dans le navigateur
//             console.error('La géolocalisation n\'est pas disponible dans ce navigateur.');
//         }
//     } else {
//         console.log('La géolocalisation est désactivée.');
//     }
// }

// document.addEventListener('DOMContentLoaded', function () {
//     // Initialiser la carte avec une vue par défaut
//     const map = L.map('map').setView([48.8534, 2.3488], 10); // Zoom plus bas

//     // Ajouter la couche de tuiles OpenStreetMap à la carte
//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '© OpenStreetMap contributors'
//     }).addTo(map);

//     // Récupérer les données de carrousel et de catégories depuis les attributs data
//     const carouselDataElement = document.getElementById('carousel-data');
//     const carouselDataJson = atob(carouselDataElement.dataset.carousel);
//     const carouselData = JSON.parse(carouselDataJson);

//     const { latitude, longitude } = carouselData;

//     // Appeler la fonction pour centrer la carte sur la position de l'utilisateur et la position du carrousel
//     centerMapOnUser(latitude, longitude, map);

//     // Forcer le redimensionnement de la carte après l'initialisation
//     setTimeout(function () {
//         map.invalidateSize();
//     }, 500);

//     // Ajouter un écouteur d'événement pour invalider la taille de la carte lors du redimensionnement de la fenêtre
//     window.addEventListener('resize', function () {
//         map.invalidateSize();
//     });
// });
function centerMapOnUser(latitude, longitude, map) {
    // Vérifier si la géolocalisation est activée dans le localStorage
    if (localStorage.getItem('geolocationEnabled') === 'true') {
        if ("geolocation" in navigator) {
            // Demander la position de l'utilisateur
            navigator.geolocation.getCurrentPosition(function (position) {
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
            }, function (error) {
                // En cas d'erreur lors de la récupération de la position de l'utilisateur
                console.error('Erreur de géolocalisation : ', error);

                // Initialiser la carte sur la position du carrousel uniquement
                map.setView([latitude, longitude], 10);
                createCarouselMarker(latitude, longitude, map);
            });
        } else {
            // Si la géolocalisation n'est pas disponible dans le navigateur
            console.error('La géolocalisation n\'est pas disponible dans ce navigateur.');

            // Initialiser la carte sur la position du carrousel uniquement
            map.setView([latitude, longitude], 10);
            createCarouselMarker(latitude, longitude, map);
        }
    } else {
        // Si la géolocalisation est désactivée, centrer la carte sur la position du carrousel
        console.log('La géolocalisation est désactivée.');
        map.setView([latitude, longitude], 10);
        createCarouselMarker(latitude, longitude, map);
    }
}

function createCarouselMarker(latitude, longitude, map) {
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
}

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les données de carrousel et de catégories depuis les attributs data
    const carouselDataElement = document.getElementById('carousel-data');
    const carouselDataJson = atob(carouselDataElement.dataset.carousel);
    const carouselData = JSON.parse(carouselDataJson);

    const { latitude, longitude } = carouselData;

    // Initialiser la carte avec une vue par défaut (vous pouvez choisir n'importe quelle vue temporaire)
    const map = L.map('map').setView([latitude, longitude], 10); // Vue initiale sur le carrousel

    // Ajouter la couche de tuiles OpenStreetMap à la carte
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Appeler la fonction pour centrer la carte sur la position de l'utilisateur et/ou la position du carrousel
    centerMapOnUser(latitude, longitude, map);

    // Forcer le redimensionnement de la carte après l'initialisation
    setTimeout(function () {
        map.invalidateSize();
    }, 500);

    // Ajouter un écouteur d'événement pour invalider la taille de la carte lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        map.invalidateSize();
    });
});
