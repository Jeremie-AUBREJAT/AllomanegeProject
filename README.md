# Allomanège

Allomanège est une plateforme web permettant aux clients de louer des manèges de fêtes foraines avec installation, mise en service, et personnel. Les forains ont un compte admin pour proposer leurs manèges à la location. Le système inclut un calendrier de réservation avec FullCalendar, et les validations des manèges et des réservations sont effectuées par un super admin. Le projet est construit avec Laravel 11, Tailwind CSS et Vite, et utilise une base de données SQL avec des migrations Laravel.

## Table des Matières

- Installation
- Utilisation
- Contact

## Installation

### Prérequis

Assurez-vous d'avoir les logiciels suivants installés sur votre système :

- Node.js (version 20.11.0)
- NPM (version 10.2.4)
- Composer (version 2.7.2)
- PHP (version 8.3.4)
- MySQL ou MariaDB

### Étapes d'installation

Clonez le dépôt :

```sh
git clone https://github.com/votre-utilisateur/allomanege.git
```

Naviguez dans le répertoire du projet :
```sh
cd allomanege
```

Installez les dépendances PHP :
```sh
composer install
```

Installez les dépendances JavaScript :
```sh
npm install
```

Copiez le fichier d’environnement :
```sh
cp .env.example .env
```

Configurez votre fichier .env avec les informations de votre base de données et autres configurations nécessaires.

Générez la clé de l’application :
```sh
php artisan key:generate
```

Exécutez les migrations :
```sh
php artisan migrate
```

Utilisation
Lancement du projet en mode développement

Pour lancer le serveur de développement Laravel :
```sh
php artisan serve
```

Pour lancer le compilateur Vite pour le front-end :
```sh
npm run dev
```

Accédez à votre application via http://localhost:8000 après avoir démarré le serveur.
Fonctionnalités

    Location de manèges : Les clients peuvent naviguer et louer des manèges de fêtes foraines.
    Compte admin pour forains : Les forains peuvent proposer leurs manèges à la location.
    Système de réservation : Les clients peuvent réserver des manèges via un calendrier interactif utilisant FullCalendar.
    Validation par super admin : Les manèges proposés et les réservations sont validés par un super admin.
    Les devis et paiements sont réalisés hors du site.

Contact

@Jeremie-AUBREJAT

Lien du projet : https://github.com/votre-utilisateur/allomanege