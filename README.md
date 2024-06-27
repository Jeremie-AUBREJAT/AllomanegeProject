<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Allomanège

Allomanège est une plateforme web permettant aux clients de louer des manèges de fêtes foraines avec installation, mise en service, et personnel. Les forains ont un compte admin pour proposer leurs manèges à la location. Le système inclut un calendrier de réservation avec FullCalendar, et les validations des manèges et des réservations sont effectuées par un super admin. Le projet est construit avec Laravel 11, Tailwind CSS et Vite, et utilise une base de données SQL avec des migrations Laravel.

## Table des Matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Contribuer](#contribuer)
- [Licence](#licence)
- [Contact](#contact)

## Installation

### Prérequis

- Node.js (version X.Y.Z)
- NPM (version A.B.C)
- Composer (version D.E.F)
- PHP (version G.H.I)
- MySQL ou MariaDB

### Étapes d'installation

1. Clonez le dépôt :
   ```sh
   git clone https://github.com/votre-utilisateur/allomanege.git

    Naviguez dans le répertoire du projet :

    sh

cd allomanege

Installez les dépendances PHP :

sh

composer install

Installez les dépendances JavaScript :

sh

npm install

Copiez le fichier d'environnement :

sh

cp .env.example .env

Configurez votre fichier .env avec les informations de votre base de données et autres configurations nécessaires.

Générez la clé de l'application :

sh

php artisan key:generate

Exécutez les migrations pour créer les tables de la base de données :

sh

    php artisan migrate

Utilisation
Lancement du projet en mode développement

Pour lancer le serveur de développement :

sh

php artisan serve

Pour lancer le compilateur Vite :

sh

npm run dev

Accès à l'application

Accédez à l'application via http://localhost:8000 après avoir démarré le serveur.
Fonctionnalités

    Location de manèges : Les clients peuvent naviguer et louer des manèges de fêtes foraines.
    Compte admin pour forains : Les forains peuvent proposer leurs manèges à la location.
    Système de réservation : Les clients peuvent réserver des manèges via un calendrier interactif utilisant FullCalendar.
    Validation par super admin : Les manèges proposés et les réservations sont validés par un super admin.

Contribuer

Les contributions sont les bienvenues ! Veuillez suivre les étapes ci-dessous pour contribuer :

    Forkez le projet
    Créez une branche pour votre fonctionnalité (git checkout -b feature/AmazingFeature)
    Committez vos modifications (git commit -m 'Add some AmazingFeature')
    Poussez votre branche (git push origin feature/AmazingFeature)
    Ouvrez une Pull Request

Licence

Distribué sous la licence MIT. Voir LICENSE pour plus d'informations.
Contact

Votre Nom - @VotrePseudo - votre.email@example.com

Lien du projet : https://github.com/votre-utilisateur/allomanege