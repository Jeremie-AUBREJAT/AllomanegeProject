
// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('registrationForm');

//     form.addEventListener('submit', function(event) {
//         event.preventDefault(); // Empêche l'envoi du formulaire par défaut

//         // Validation des champs
//         if (validateForm()) {
//             sendData();
//         }
//     });

//     function validateForm() {
//         // Récupération des valeurs des champs
//         const name = document.getElementById('name').value.trim();
//         const surname = document.getElementById('surname').value.trim();
//         const email = document.getElementById('email').value.trim();
//         const password = document.getElementById('password').value.trim();
//         const passwordConfirmation = document.getElementById('password_confirmation').value.trim();
//         const streetName = document.getElementById('street_name').value.trim();
//         const postalCode = document.getElementById('postal_code').value.trim();
//         const city = document.getElementById('city').value.trim();
//         const country = document.getElementById('country').value.trim();
//         const phoneNumber = document.getElementById('phone_number').value.trim();
//         const rgpdConsent = document.getElementById('rgpd_consent').checked;
//         const professional = document.getElementById('professional').checked;

//         // Validation des champs obligatoires
//         if (name === '' || surname === '' || email === '' || password === '' ||
//             streetName === '' || postalCode === '' || city === '' || country === '' ||
//             phoneNumber === '' || !rgpdConsent) {
//             alert('Veuillez remplir tous les champs obligatoires.');
//             return false;
//         }

//         // Validation de l'email avec une expression régulière
//         const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         if (!emailRegex.test(email)) {
//             alert('Veuillez entrer une adresse email valide.');
//             return false;
//         }

//         // Validation du mot de passe avec les règles définies dans Laravel
//         const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,100}$/;
//         if (!passwordRegex.test(password)) {
//             alert('Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial, et doit faire entre 8 et 100 caractères.');
//             return false;
//         }

//         // Vérification que les mots de passe correspondent
//         if (password !== passwordConfirmation) {
//             alert('Les mots de passe ne correspondent pas.');
//             return false;
//         }

//         return true;
//     }

//     function sendData() {
//         // Construction de l'objet FormData à envoyer
//         const formData = new FormData(form);

//         fetch('/register', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Erreur lors de la requête.');
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Traitement de la réponse si nécessaire
//             console.log('Réponse du serveur :', data);
//             // Redirection ou autre action après traitement
//             window.location.href = '/some-success-page'; // Exemple de redirection
//         })
//         .catch(error => {
//             console.error('Erreur :', error);
//             alert('Une erreur est survenue. Veuillez réessayer.');
//             // Gérer l'erreur d'une manière appropriée
//         });
//     }
// });
