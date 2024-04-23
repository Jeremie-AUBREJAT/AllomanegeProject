document.getElementById('addImageField').addEventListener('click', function() {
    var imageFields = document.getElementById('imageFields');
    var currentImageFieldsCount = imageFields.children.length;
    
    if (currentImageFieldsCount < 5) {
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