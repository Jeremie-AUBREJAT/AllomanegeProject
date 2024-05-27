
    // Cache pour stocker les suggestions d'adresse
    let addressSuggestions = {};

    // Fonction pour récupérer les suggestions d'adresse depuis l'API
    async function fetchAddressSuggestions(inputValue) {
        if (!addressSuggestions[inputValue]) {
            const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${inputValue}&limit=5`);
            const data = await response.json();
            addressSuggestions[inputValue] = data.features.map(feature => ({
                label: feature.properties.label,
                street: feature.properties.name,
                housenumber: feature.properties.housenumber,
                postcode: feature.properties.postcode,
                citycode: feature.properties.citycode,
                city: feature.properties.city,
                country: 'France', // Valeur par défaut
                lon: feature.geometry.coordinates[0],
                lat: feature.geometry.coordinates[1]
            }));
        }
    }

    // Fonction d'autocomplétion
    function autocomplete(inputElement, suggestionElementId) {
        inputElement.addEventListener('input', function() {
            const inputValue = this.value.trim();
            if (inputValue.length >= 3) {
                fetchAddressSuggestions(inputValue).then(() => {
                    const suggestions = addressSuggestions[inputValue] || [];
                    const suggestionElement = document.getElementById(suggestionElementId);
                    suggestionElement.innerHTML = suggestions.map(suggestion => `<div>${suggestion.label}</div>`).join('');
                });
            } else {
                document.getElementById(suggestionElementId).innerHTML = '';
            }
        });
    }

    // Fonction pour remplir les champs du formulaire avec les données de l'adresse sélectionnée
    function fillAddressFields(selectedSuggestion) {
        document.getElementById('street_name').value = selectedSuggestion.street || '';
        document.getElementById('street_number').value = selectedSuggestion.housenumber || '';
        document.getElementById('postal_code').value = selectedSuggestion.postcode || '';
        document.getElementById('city').value = selectedSuggestion.city || '';
        document.getElementById('country').value = 'France'; // Valeur par défaut
    }

    // Gestionnaire d'événements de clic pour les suggestions d'adresse
    document.getElementById('search-suggestions').addEventListener('click', function(event) {
        if (event.target.tagName === 'DIV') {
            const suggestionText = event.target.innerText;
            const selectedSuggestion = addressSuggestions[document.getElementById('search').value.trim()].find(s => s.label === suggestionText);
            fillAddressFields(selectedSuggestion);
        }
    });

    // Initialise l'autocomplétion pour chaque champ d'entrée du formulaire
    autocomplete(document.getElementById('search'), 'search-suggestions');
    autocomplete(document.getElementById('country'), 'country-suggestions');
    autocomplete(document.getElementById('postal_code'), 'postal_code-suggestions');
    autocomplete(document.getElementById('city'), 'city-suggestions');
    autocomplete(document.getElementById('street_name'), 'street_name-suggestions');
    autocomplete(document.getElementById('street_number'), 'street_number-suggestions');

