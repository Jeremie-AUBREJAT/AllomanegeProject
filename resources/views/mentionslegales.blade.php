@extends('layouts.appsecond')
@section('title', 'Mentions légales')
@section('content')
<section class="bg-custom-blue2 py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Div pour l'erreur de chargement de la page -->
        <div class="text-white p-8 mb-8 flex flex-col items-center">
            <h2 class="text-4xl font-semibold mb-4">MENTIONS LÉGALES</h2>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white mr-2">
                    <path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                </svg>
                <p class="text-white">HOME</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white ml-4 mr-2">
                    <path d="m19 12-7-6v5H6v2h6v5z"/>
                </svg>
                <p class="text-white">MENTIONS LÉGALES</p>
            </div>
        </div>
        
    </div>
    
</section>
<section class="py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
    <h2 class="text-custom-font-blue text-4xl font-semibold mb-4">MENTIONS LÉGALES</h2>
    <section class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">1. Informations légales</h2>
        <p class="text-xl">Nom de l'entreprise : [Votre Nom]</p>
        <p class="text-xl">Statut juridique : [Votre statut juridique]</p>
        <p class="text-xl">Adresse : [Votre adresse]</p>
        <p class="text-xl">Email : [Votre email]</p>
        <p class="text-xl">Téléphone : [Votre numéro de téléphone]</p>
        <p class="text-xl">Numéro SIRET : [Votre numéro SIRET]</p>
        <p class="text-xl">Responsable de la publication : [Votre nom]</p>
    </section>
    
    <section class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">2. Hébergement du site</h2>
        <p class="text-xl">Nom de l'hébergeur : [Nom de l'hébergeur]</p>
        <p class="text-xl">Adresse de l'hébergeur : [Adresse de l'hébergeur]</p>
        <p class="text-xl">Numéro de téléphone de l'hébergeur : [Numéro de téléphone de l'hébergeur]</p>
    </section>
    
    <section class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">3. Données personnelles</h2>
        <p class="text-xl">Les données personnelles collectées sur ce site sont traitées par [Votre Nom] en tant que responsable de traitement.</p>
        <p class="text-xl">Finalités du traitement des données : [Expliquez ici les finalités du traitement des données]</p>
        <p class="text-xl">Les informations recueillies font l'objet d'un traitement informatique destiné à [Indiquez la finalité du traitement].</p>
        <p class="text-xl">Conformément à la réglementation applicable en matière de protection des données personnelles, vous disposez d'un droit d'accès, de rectification, d'effacement et d'opposition pour les informations vous concernant. Pour exercer ces droits, veuillez contacter [Votre adresse email].</p>
    </section>
    
    <a href="/" class="mt-16 inline-block bg-custom-orange hover:bg-orange-600 text-white font-bold py-2 px-4">Retour à la page d'accueil</a>
</div>
</div>
</section>
@endsection