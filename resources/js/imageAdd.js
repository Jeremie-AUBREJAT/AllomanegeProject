
var currentUrl = window.location.href;

if (currentUrl.includes('create') || currentUrl.includes('update')) {
    document.getElementById('addImageField').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire

        var imageFields = document.getElementById('imageFields');
        var addButton = document.getElementById('addImageField');
        var currentImageFieldsCount = imageFields.querySelectorAll('input[type="file"]').length;

        var totalImageCount = currentImageFieldsCount;

        if (currentUrl.includes('update')) {
            var existingImagesCount = document.querySelectorAll('.existing-image').length;
            totalImageCount += existingImagesCount;
        }

        if (totalImageCount < 5) {
            // Créer un nouveau champ d'image et un conteneur de prévisualisation associé
            var newImageField = document.createElement('div');
            newImageField.classList.add('mb-4');
            var newImageFieldId = 'imageField' + (totalImageCount + 1);

            newImageField.innerHTML = `
                <label for="imageCreate${totalImageCount + 1}" class="block mb-2">Image :</label>
                <input type="file" name="imageCreate[]" id="imageCreate${totalImageCount + 1}" class="border rounded-md px-3 py-2 w-full" multiple>
                <div id="previewContainer${totalImageCount + 1}" class="mt-4"></div>
            `;

            // Insérer le nouveau champ d'image juste au-dessus du bouton "Ajouter une autre image"
            imageFields.insertBefore(newImageField, addButton);
            document.getElementById(`imageCreate${totalImageCount + 1}`).addEventListener('change', function(event) {
                previewImages(event, `previewContainer${totalImageCount + 1}`);
            });
        } else {
            alert('Vous ne pouvez pas ajouter plus de 5 images.');
        }
    });

    document.getElementById('imageCreate').addEventListener('change', function(event) {
        previewImages(event, 'previewContainer');
    });
}

function previewImages(event, previewContainerId) {
    var files = event.target.files;
    var previewContainer = document.getElementById(previewContainerId);
    previewContainer.innerHTML = ''; // Clear existing previews

    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        if (file.type.startsWith('image/')) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-32', 'h-32', 'object-cover', 'mr-2', 'mb-2');
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
}

