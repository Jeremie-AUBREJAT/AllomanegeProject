document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner le slider
    const slider = document.getElementById("prix");
    // Sélectionner l'élément du texte du prix
    const prixValue = document.getElementById("prix-value");

    // Mettre à jour le texte du prix à chaque changement de valeur du slider
    slider.addEventListener("input", function() {
        prixValue.textContent = `${this.value} €`;
    });
});
