const validations = {
    name: {
        validate: value => value.trim().length >= 2 && value.trim().length <= 100,
        message: "Le nom est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
    },
    surname: {
        validate: value => value.trim().length >= 2 && value.trim().length <= 100,
        message: "Le prénom est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
    },
    compagny: {
        validate: value => value === null || (value.trim().length <= 100),
        message: "Le nom de l'entreprise ne doit pas dépasser 100 caractères."
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
    phone_number: {
        validate: value => /^[\d\s\+\-]{2,50}$/.test(value),
        message: "Le numéro de téléphone est requis et doit contenir entre 2 et 50 caractères et peut inclure des chiffres, des espaces, des signes plus ou moins."
    },
    email: {
        validate: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) && value.length <= 100,
        message: "L'adresse email doit être valide et ne doit pas dépasser 100 caractères."
    }
};

const submitButton = document.getElementById('submitBtn'); // Assurez-vous que l'ID correspond à votre bouton

const checkValidity = () => {
    let isValid = true;
    for (const [field, validatorObj] of Object.entries(validations)) {
        const input = document.getElementById(field);
        if (!input) {
            console.error(`Input field with id '${field}' not found.`);
            continue; // Passe au champ suivant s'il n'est pas trouvé
        }
        const isValidField = validatorObj.validate(input.value);
        const errorElement = document.getElementById(`${field}-error`);
        if (!isValidField) {
            isValid = false;
            if (errorElement) {
                errorElement.textContent = validatorObj.message;
            }
        } else {
            if (errorElement) {
                errorElement.textContent = ''; // Efface le message d'erreur s'il devient valide
            }
        }
    }
    return isValid;
};

const handleSubmit = (event) => {
    if (!checkValidity()) {
        event.preventDefault(); // Empêche l'envoi du formulaire si la validation échoue  
    } 
};

submitButton.addEventListener('click', handleSubmit);

// modification du MDP

const validationPass = {
    current_password: {
        validate: value => value.trim().length > 0,
        message: "Le mot de passe actuel est requis."
    },
    password: {
        validate: value => {
            const minLength = value.length >= 8;
            const maxLength = value.length <= 100;
            const hasUpperCase = /[A-Z]/.test(value);
            const hasLowerCase = /[a-z]/.test(value);
            const hasDigit = /[0-9]/.test(value);
            const hasSpecialChar = /[\W_]/.test(value);
            return minLength && maxLength && hasUpperCase && hasLowerCase && hasDigit && hasSpecialChar;
        },
        message: "Le mot de passe doit contenir entre 8 et 100 caractères, incluant au moins une majuscule, une minuscule, un chiffre et un caractère spécial."
    },
    password_confirmation: {
        validate: value => value === document.querySelector('#update_password_password').value,
        message: "La confirmation du mot de passe doit correspondre au nouveau mot de passe."
    }
};

const submitBouton = document.querySelector('#submitBtnPass'); 

const checkValidityPass = () => {
    let isValid = true;
    let globalErrorMessage = '';
    for (const [field, validatorObj] of Object.entries(validationPass)) {
        const input = document.querySelector(`#update_password_${field}`);
        if (!input) {
            console.error(`Input field with id 'update_password_${field}' not found.`);
            continue; 
        }
        const isValidField = validatorObj.validate(input.value);
        const errorElement = document.querySelector(`#update_password_${field}-error`);
        if (!isValidField) {
            isValid = false;
            if (errorElement) {
                errorElement.textContent = validatorObj.message;
            }
            globalErrorMessage = 'Certains champs contiennent des erreurs. Veuillez les corriger avant de soumettre le formulaire.';
        } else {
            if (errorElement) {
                errorElement.textContent = ''; 
            }
        }
    }
    const globalErrorElement = document.querySelector('#global-error');
    if (globalErrorElement) {
        globalErrorElement.textContent = globalErrorMessage;
    }
    return isValid;
};

const handleSubmitPass = (event) => {
    if (!checkValidityPass()) {
        event.preventDefault(); 
        console.log('Validation failed, form submission prevented.');
    } else {
        console.log('Form is valid, proceeding with submission.');
    }
};

submitBouton.addEventListener('click', handleSubmitPass);
