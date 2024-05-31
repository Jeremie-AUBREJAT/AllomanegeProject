document.addEventListener('DOMContentLoaded', () => {
    const prixSlider = document.getElementById('prix');
    const prixValue = document.getElementById('prix-value');
    const searchButton = document.getElementById('search-button');
    const categoryFilter = document.getElementById('category-filter');
    const nameInput = document.getElementById('name'); // Sélection de l'input pour le nom du manège
    const dateStartInput = document.getElementById('date-start'); // Sélection de l'input pour la date de début
    const dateEndInput = document.getElementById('date-end'); // Sélection de l'input pour la date de fin

    // Définir la valeur initiale du slider à 0
    prixSlider.value = 15000;
    prixValue.textContent = '15000 €';

    prixSlider.addEventListener('input', () => {
        prixValue.textContent = `${prixSlider.value} €`;
    });

    searchButton.addEventListener('click', () => {
        let prix = prixSlider.value;
        const category = categoryFilter.value;
        const name = nameInput.value; // Récupérer la valeur du champ "Nom du manège"
        const dateStart = dateStartInput.value; // Récupérer la valeur du champ "Date de début"
        const dateEnd = dateEndInput.value; // Récupérer la valeur du champ "Date de fin"

        // Si la valeur du prix est égale à 0, définissez-la comme une chaîne vide
        if (prix === '0') {
            prix = '';
        }

        const url = `/manèges?maxPrice=${prix}&category=${category}&name=${name}&dateStart=${dateStart}&dateEnd=${dateEnd}`; // Ajouter les valeurs des dates à l'URL
        window.open(url, '_blank');
    });
});