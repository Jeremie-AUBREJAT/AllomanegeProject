

// document.addEventListener('DOMContentLoaded', function () {
//     const modal = document.getElementById('consentModal');
//     const openModalBtn = document.getElementById('openConsentModal');
//     const toggleGeolocation = document.getElementById('toggleGeolocation');
//     const toggleButton = document.getElementById('toggleButton');
//     const geolocationStatus = document.getElementById('geolocationStatus');
//     const saveBtn = document.getElementById('saveSettings');

//     // Vérifie si la géolocalisation est activée dans le localStorage
//     function checkGeolocationStatus() {
//         return localStorage.getItem('geolocationEnabled') === 'true';
//     }

//     // Active le bouton "Enregistrer et accepter"
//     function enableSaveButton() {
//         saveBtn.disabled = false;
//     }

//     // Affiche la modal de consentement
//     function showModal() {
//         modal.classList.remove('hidden');
//     }

//     // Cache la modal de consentement
//     function hideModal() {
//         modal.classList.add('hidden');
//     }

//     // Met à jour l'état de la géolocalisation
//     function updateGeolocationStatus(enabled) {
//         if (enabled) {
//             localStorage.setItem('geolocationEnabled', 'true');
//             geolocationStatus.textContent = 'Activé';
//             toggleButton.classList.remove('translate-x-0');
//             toggleButton.classList.add('translate-x-full');
//         } else {
//             localStorage.removeItem('geolocationEnabled');
//             geolocationStatus.textContent = 'Désactivé';
//             toggleButton.classList.remove('translate-x-full');
//             toggleButton.classList.add('translate-x-0');
//         }
//         enableSaveButton();  // Active le bouton "Enregistrer et accepter"
//     }

//     // Initialise l'état du toggle au chargement de la page
//     toggleGeolocation.checked = checkGeolocationStatus();
//     if (checkGeolocationStatus()) {
//         updateGeolocationStatus(true);
//     }

//     // Écouteur pour le changement d'état du toggle
//     toggleGeolocation.addEventListener('change', function () {
//         const geolocationEnabled = toggleGeolocation.checked;
//         updateGeolocationStatus(geolocationEnabled);
//     });

//     // Ouvre la modal lorsque l'utilisateur clique sur le bouton "Paramètres de Confidentialité"
//     openModalBtn.addEventListener('click', showModal);

//     // Affiche la modal si aucune donnée de consentement n'est trouvée dans le localStorage
//     const consent = localStorage.getItem('consent');
//     if (!consent) {
//         showModal();
//     }

//     // Enregistre le consentement et rafraîchit la page après un délai
//     saveBtn.addEventListener('click', function () {
//         localStorage.setItem('consent', 'true');
//         hideModal();
//         setTimeout(function() {
//             location.reload();
//         }, 500);  // Temporisation de 500 ms avant le rafraîchissement
//     });

//     // Ferme la modal et enregistre le consentement si l'utilisateur clique en dehors de la modal
//     modal.addEventListener('click', function (event) {
//         if (event.target === modal) {
//             localStorage.setItem('consent', 'true');
//             hideModal();
//             setTimeout(function() {
//                 location.reload();
//             }, 0);  // Temporisation de 0 ms avant le rafraîchissement
//         }
//     });

//     // Désactiver le bouton de sauvegarde par défaut
//     saveBtn.disabled = true;
// });

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('consentModal');
    const openModalBtn = document.getElementById('openConsentModal');
    const toggleGeolocation = document.getElementById('toggleGeolocation');
    const toggleButton = document.getElementById('toggleButton');
    const geolocationStatus = document.getElementById('geolocationStatus');
    const saveBtn = document.getElementById('saveSettings');

    // Vérifie si la géolocalisation est activée dans le localStorage
    function checkGeolocationStatus() {
        return localStorage.getItem('geolocationEnabled') === 'true';
    }

    // Affiche la modal de consentement
    function showModal() {
        modal.classList.remove('hidden');
    }

    // Cache la modal de consentement
    function hideModal() {
        modal.classList.add('hidden');
    }

    // Met à jour l'état de la géolocalisation
    function updateGeolocationStatus(enabled) {
        if (enabled) {
            localStorage.setItem('geolocationEnabled', 'true');
            geolocationStatus.textContent = 'Activé';
            geolocationStatus.classList.remove('text-red-600');
            geolocationStatus.classList.add('text-green-500');
            toggleButton.style.transform = 'translateX(0)';
        } else {
            localStorage.removeItem('geolocationEnabled');
            geolocationStatus.textContent = 'Désactivé';
            geolocationStatus.classList.remove('text-green-500');
            geolocationStatus.classList.add('text-red-600');
            toggleButton.style.transform = 'translateX(100%)';
        }
    }

    // Initialise l'état du toggle au chargement de la page
    toggleGeolocation.checked = checkGeolocationStatus();
    updateGeolocationStatus(checkGeolocationStatus());

    // Écouteur pour le changement d'état du toggle
    toggleGeolocation.addEventListener('change', function () {
        const geolocationEnabled = toggleGeolocation.checked;
        updateGeolocationStatus(geolocationEnabled);
    });

    // Ouvre la modal lorsque l'utilisateur clique sur le bouton "Paramètres de Confidentialité"
    openModalBtn.addEventListener('click', showModal);

    // Affiche la modal si aucune donnée de consentement n'est trouvée dans le localStorage
    const consent = localStorage.getItem('consent');
    if (!consent) {
        showModal();
    }

    // Enregistre le consentement et rafraîchit la page après un délai
    saveBtn.addEventListener('click', function () {
        localStorage.setItem('consent', 'true');
        hideModal();
        setTimeout(function() {
            location.reload();
        }, 500);  // Temporisation de 500 ms avant le rafraîchissement
    });

    // Ferme la modal et enregistre le consentement si l'utilisateur clique en dehors de la modal
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            localStorage.setItem('consent', 'true');
            hideModal();
            setTimeout(function() {
                location.reload();
            }, 0);  // Temporisation de 0 ms avant le rafraîchissement
        }
    });

    // Activer le bouton "Enregistrer et accepter" par défaut
    saveBtn.disabled = false;
});
