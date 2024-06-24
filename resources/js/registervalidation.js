
const validations = {
    name: {
        validate: value => value.trim().length >= 2 && value.trim().length <= 100,
        message: "Le nom est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
    },
    surname: {
        validate: value => value.trim().length >= 2 && value.trim().length <= 100,
        message: "Le prénom est requis et doit contenir au moins 2 caractères et ne pas dépasser 100 caractères."
    },
    email: {
        validate: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) && value.length <= 100,
        message: "L'adresse email doit être valide et ne doit pas dépasser 100 caractères."
    },
    password: {
        validate: value => /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,100}$/.test(value),
        message: "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, un caractère spécial et avoir entre 8 et 100 caractères."
    },
    password_confirmation: {
        validate: value => value === document.getElementById('password').value,
        message: "La confirmation du mot de passe ne correspond pas au mot de passe saisi."
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
        validate: value => value.trim().length >= 2 && value.trim().length <= 50,
        message: "Le numéro de téléphone est requis et doit contenir au moins 2 caractères et ne pas dépasser 50 caractères."
    },
    rgpd_consent: {
        validate: () => document.getElementById('rgpd_consent').checked,
        message: "Vous devez accepter la politique de confidentialité."
    }
};

const form = document.getElementById('registrationForm');
const registerButton = document.getElementById('registerButton');

const checkValidity = () => {
    let isValid = true;
    for (const [field, validatorObj] of Object.entries(validations)) {
        const input = document.getElementById(field);
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
        // Afficher des messages d'erreur globaux si nécessaire
    }
};

form.addEventListener('submit', handleSubmit);
