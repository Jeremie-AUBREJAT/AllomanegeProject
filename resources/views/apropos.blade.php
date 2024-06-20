@extends('layouts.appsecond')
@section('title', 'À propos')
@section('content')
<section class="bg-custom-blue2 py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Div pour l'erreur de chargement de la page -->
        <div class="text-white p-8 mb-8 flex flex-col items-center">
            <h2 class="text-4xl font-semibold mb-4">À PROPOS</h2>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white mr-2">
                    <path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                </svg>
                <p class="text-white">HOME</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white ml-4 mr-2">
                    <path d="m19 12-7-6v5H6v2h6v5z"/>
                </svg>
                <p class="text-white">À PROPOS</p>
            </div>
        </div>
        
    </div>
    
</section>
<section class="py-12 px-4 lg:px-8">
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <p class="mb-4 text-3xl font-semibold">Bienvenue sur Allomanège !</p>
            <p class="mb-4">
                Allomanège est votre plateforme dédiée à la location de manèges de fête foraine, offrant des services de montage et de fonctionnement pour les professionnels et les particuliers. Que vous soyez un particulier souhaitant ajouter une touche magique à votre événement ou une entreprise recherchant des attractions de qualité, Allomanège est là pour vous aider.
            </p>

            <h3 class="text-2xl font-semibold mb-4">Notre Mission</h3>
            <p class="mb-4">
                Notre mission est simple : rendre les fêtes foraines accessibles à tous, en fournissant des manèges et des services de qualité supérieure. Nous connectons les professionnels du monde forain avec ceux qui cherchent à louer des manèges pour diverses occasions, assurant ainsi une expérience festive inoubliable.
            </p>

            <h3 class="text-2xl font-semibold mb-4">Nos Services</h3>
            <ul class="list-disc list-inside mb-4">
                <li class="mb-2">Location de Manèges : Choisissez parmi une vaste sélection de manèges disponibles pour tous types d'événements, des fêtes d'anniversaire aux grandes célébrations d'entreprise.</li>
                <li class="mb-2">Montage et Fonctionnement : Nous offrons des services complets de montage et de fonctionnement pour assurer la sécurité et le bon déroulement de votre événement.</li>
                <li class="mb-2">Partenariat avec des Forains Professionnels : Les forains professionnels peuvent ajouter leurs manèges et services sur notre plateforme, permettant ainsi une réservation facile par des particuliers et des entreprises.</li>
            </ul>

            <h3 class="text-2xl font-semibold mb-4">Pourquoi Choisir Allomanège ?</h3>
            <ul class="list-disc list-inside mb-4">
                <li class="mb-2">Sélection Variée : Nous proposons une large gamme de manèges pour tous les goûts et toutes les tailles d'événements.</li>
                <li class="mb-2">Services Complètes : De la location au montage et au fonctionnement, nous nous occupons de tout pour vous.</li>
                <li class="mb-2">Pour Professionnels et Particuliers : Que vous soyez un professionnel ou un particulier, nous avons des solutions adaptées à vos besoins.</li>
                <li class="mb-2">Plateforme de Confiance : Allomanège est une plateforme sécurisée où les forains professionnels peuvent présenter leurs manèges et services en toute confiance.</li>
            </ul>

            <h3 class="text-2xl font-semibold mb-4">Rejoignez Notre Communauté</h3>
            <p class="mb-4">
                Vous êtes un forain professionnel ? Rejoignez notre plateforme pour présenter vos manèges et services. En ajoutant vos attractions à Allomanège, vous pourrez être réservé par des entreprises et des particuliers à la recherche d'expériences uniques pour leurs événements.
            </p>

            <h3 class="text-2xl font-semibold mb-4">Nous Contacter</h3>
            <p>
                Pour toute question ou demande, n'hésitez pas à nous contacter via <a href="contact" class="text-blue-500 underline">contact@allomanege.com</a> ou à nous suivre sur nos réseaux sociaux.
            </p>
        </div>
    </div>
</section>
@endsection