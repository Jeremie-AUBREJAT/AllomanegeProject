document.addEventListener('DOMContentLoaded', () => {
    const validations = {
        name: {
            validate: value => value.trim().length >= 2 && value.trim().length <= 100,
            message: "Le nom est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
        },
        length: {
            validate: value => !isNaN(value) && value.trim() !== '' && parseFloat(value) >= 1,
            message: "La longueur doit être un nombre supérieur ou égal à 1."
        },
        width: {
            validate: value => !isNaN(value) && value.trim() !== '' && parseFloat(value) >= 1,
            message: "La largeur doit être un nombre supérieur ou égal à 1."
        },
        weight: {
            validate: value => Number.isInteger(parseFloat(value)) && parseFloat(value) >= 1,
            message: "Le poids doit être un nombre entier supérieur ou égal à 1."
        },
        watt_power: {
            validate: value => Number.isInteger(parseFloat(value)) && parseFloat(value) >= 1,
            message: "La puissance en watts doit être un nombre entier supérieur ou égal à 1."
        },
        install_time: {
            validate: value => !isNaN(value) && value.trim() !== '' && parseFloat(value) >= 1,
            message: "Le temps d'installation doit être un nombre supérieur ou égal à 1."
        },
        description: {
            validate: value => value.trim().length >= 10 && value.trim().length <= 500,
            message: "La description est requise et doit contenir entre 10 et 500 caractères."
        },
        street_number: {
            validate: value => value.trim().length <= 20,
            message: "Le numéro de rue ne doit pas dépasser 20 caractères."
        },
        street_name: {
            validate: value => value.trim().length >= 2 && value.trim().length <= 100,
            message: "Le nom de rue est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
        },
        postal_code: {
            validate: value => value.trim().length >= 2 && value.trim().length <= 20,
            message: "Le code postal est requis et doit contenir au moins 2 caractères et ne pas dépasser 20 caractères."
        },
        city: {
            validate: value => value.trim().length >= 2 && value.trim().length <= 100,
            message: "La ville est requise et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
        },
        country: {
            validate: value => value.trim().length >= 2 && value.trim().length <= 100,
            message: "Le pays est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
        },
        price: {
            validate: value => !isNaN(value) && parseFloat(value) >= 1,
            message: "Le prix doit être un nombre supérieur ou égal à 1."
        },
        imageUpdate: {
            validate: files => {
                if (files.length < 1 || files.length > 5) {
                    return false;
                }
                return [...files].every(file => /\.(jpg|jpeg)$/i.test(file.name));
            },
            message: "Vous devez sélectionner entre 1 et 5 images au format 'jpg' ou 'jpeg'."
        }
    };

    const form = document.getElementById('carouselForm');

    const checkValidity = () => {
        let isValid = true;
        const fileInputs = document.querySelectorAll('input[name="imageUpdate[]"]');
        
        // Réinitialiser les messages d'erreur
        for (const [field, validatorObj] of Object.entries(validations)) {
            const errorElement = document.getElementById(`${field}Error`);
            if (errorElement) {
                errorElement.textContent = '';
            }
        }
        fileInputs.forEach(input => {
            input.classList.remove('border-red-500');
        });

        // Valider chaque champ
        for (const [field, validatorObj] of Object.entries(validations)) {
            if (field !== 'imageUpdate') {
                const input = document.getElementById(field);
                const isValidField = validatorObj.validate(input.value);
                const errorElement = document.getElementById(`${field}Error`);
        
                if (!isValidField) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.textContent = validatorObj.message;
                    }
                    if (input) {
                        input.classList.add('border-red-500');
                    }
                } else {
                    if (errorElement) {
                        errorElement.textContent = '';
                    }
                    if (input) {
                        input.classList.remove('border-red-500');
                    }
                }
            }
        }

        // Valider les fichiers
        const totalFiles = fileInputs.length;
        const imageUpdateValidator = validations['imageUpdate'];
        const filesToValidate = Array.from(fileInputs).reduce((acc, input) => acc.concat(Array.from(input.files)), []);
        const isValidImages = imageUpdateValidator.validate(filesToValidate);
        const imageUpdateError = document.getElementById('imageUpdateError');

        // Vérifier s'il y a des images existantes associées au carrousel
        const existingImages = document.querySelectorAll('.existing-image img');
        const hasExistingImages = existingImages.length > 0;

        if (hasExistingImages && totalFiles === 0) {
            isValid = false;
            if (imageUpdateError) {
                imageUpdateError.textContent = "Vous devez sélectionner au moins une image.";
            }
            fileInputs.forEach(input => {
                input.classList.add('border-red-500');
            });
        } else if (totalFiles === 0) {
            isValid = false;
            if (imageUpdateError) {
                imageUpdateError.textContent = "Vous devez sélectionner au moins une image.";
            }
            fileInputs.forEach(input => {
                input.classList.add('border-red-500');
            });
        } else {
            if (imageUpdateError) {
                imageUpdateError.textContent = '';
            }
            fileInputs.forEach(input => {
                input.classList.remove('border-red-500');
            });
        }

        return isValid;
    };

    form.addEventListener('submit', (event) => {
        if (!checkValidity()) {
            event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
        }
    });
});
