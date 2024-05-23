// Vérifier si l'URL contient 'create' ou 'update'
var currentUrl = window.location.href;
if (currentUrl.includes('create') || currentUrl.includes('update')) {
    // Attacher un gestionnaire d'événements au clic sur le bouton
    document.getElementById('addImageField').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire

        var imageFields = document.getElementById('imageFields');
        var currentImageFieldsCount = imageFields.children.length;

        var totalImageCount = currentImageFieldsCount;
        
        // Si c'est une page 'update', comptez également les images déjà présentes
        if (currentUrl.includes('update')) {
            var existingImagesCount = document.querySelectorAll('.existing-image').length;
            totalImageCount += existingImagesCount;
        }

        if (totalImageCount < 6) {
            // Créer un nouveau champ d'image
            var newImageField = document.createElement('div');
            newImageField.classList.add('mb-4');
            newImageField.innerHTML = `
                <label for="imageCreate" class="block mb-2">Image :</label>
                <input type="file" name="imageCreate[]" class="border rounded-md px-3 py-2 w-full" multiple>
            `;
            imageFields.appendChild(newImageField);
        } else {
            alert('Vous ne pouvez pas ajouter plus de 5 images.');
        }
    });
}
