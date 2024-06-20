@extends('layouts.appsecond')

@section('title', 'Politique de confidentialité')

@section('content')
    <section class="bg-custom-blue2 py-12 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Div pour l'erreur de chargement de la page -->
            <div class="text-white p-8 mb-8 flex flex-col items-center">
                <h2 class="text-4xl font-semibold mb-4">POLITIQUE DE CONFIDENTIALITÉ</h2>

                <!-- Navigation -->
                <div class="flex items-center mt-4">
                    <!-- Home SVG et texte -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-white mr-2">
                        <path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                    </svg>
                    <p class="text-white">HOME</p>
                    <!-- Politique de confidentialité SVG et texte -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current text-white ml-4 mr-2">
                        <path d="m19 12-7-6v5H6v2h6v5z"/>
                    </svg>
                    <p class="text-white">POLITIQUE DE CONFIDENTIALITÉ</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Politique de confidentialité -->
    <section class="bg-white p-8 rounded-lg shadow-lg px-8">
        <div>
            <h3 class="text-2xl font-bold mb-4">Introduction</h3>
            <p class="mb-4">
                Chez Allomanège, nous nous engageons à protéger votre vie privée. Cette politique de confidentialité explique comment nous collectons, utilisons, stockons et protégeons les informations personnelles que vous nous fournissez. En utilisant notre site web ou nos services, vous acceptez les pratiques décrites dans cette politique.
            </p>

            <h3 class="text-2xl font-bold mb-4">Informations que nous collectons</h3>
            <p class="mb-4">Nous pouvons collecter les types d'informations suivants :</p>
            <ul class="list-disc pl-6 mb-4">
                <li>Informations personnelles : Nom, prénom, adresse postale, adresse e-mail, numéro de téléphone, et autres informations similaires nécessaires pour la gestion de votre compte et vos réservations.</li>
                <li>Informations de compte : Nom d'utilisateur, mot de passe, et autres détails d'inscription.</li>
            </ul>

            <h3 class="text-2xl font-bold mb-4">Comment nous utilisons vos informations</h3>
            <p class="mb-4">Nous utilisons vos informations pour les raisons suivantes :</p>
            <ul class="list-disc pl-6 mb-4">
                <li>Fourniture de services : Pour gérer et améliorer notre service de location de manèges.</li>
                <li>Communication : Pour communiquer avec vous, répondre à vos demandes et vous envoyer des mises à jour importantes concernant vos réservations.</li>
                <li>Sécurité : Pour protéger la sécurité et l'intégrité de notre site web et de nos services.</li>
                <li>Conformité légale : Pour respecter les obligations légales et appliquer nos conditions générales.</li>
            </ul>

            <h3 class="text-2xl font-bold mb-4">Accès à vos informations</h3>
            <p class="mb-4">
                Seuls les administrateurs d'Allomanège ont accès aux informations de tous les utilisateurs. Ces informations sont stockées dans une base de données MySQL sécurisée.
            </p>

            <h3 class="text-2xl font-bold mb-4">Partage de vos informations</h3>
            <p class="mb-4">
                Vos informations personnelles ne sont pas partagées avec des tiers. Elles sont exclusivement utilisées dans le cadre de notre service de location de manèges.
            </p>

            <h3 class="text-2xl font-bold mb-4">Cookies et stockage des données</h3>
            <p class="mb-4">
                Nous utilisons les cookies de session Breeze pour améliorer votre expérience utilisateur sur notre site. Vous pouvez activer ou désactiver la géolocalisation dans les paramètres de votre navigateur.
            </p>

            <h3 class="text-2xl font-bold mb-4">Stockage des données</h3>
            <p class="mb-4">
                Vos informations personnelles sont enregistrées dans le local storage de votre navigateur ainsi que dans notre base de données MySQL. Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos informations personnelles contre l'accès non autorisé, la divulgation, la modification et la destruction.
            </p>

            <h3 class="text-2xl font-bold mb-4">Vos droits</h3>
            <p class="mb-4">Vous disposez des droits suivants concernant vos informations personnelles :</p>
            <ul class="list-disc pl-6 mb-4">
                <li>Accès : Vous pouvez demander l'accès à vos informations personnelles.</li>
                <li>Correction : Vous pouvez demander la correction de toute information personnelle inexacte ou incomplète.</li>
                <li>Suppression : Vous pouvez demander la suppression de vos informations personnelles.</li>
                <li>Opposition : Vous pouvez vous opposer au traitement de vos informations personnelles.</li>
            </ul>

            <h3 class="text-2xl font-bold mb-4">Modifications de cette politique</h3>
            <p class="mb-4">
                Nous pouvons mettre à jour cette politique de confidentialité de temps en temps. Nous vous informerons de tout changement important en publiant la nouvelle politique sur notre site web.
            </p>

            <h3 class="text-2xl font-bold mb-4">Contactez-nous</h3>
            <p class="mb-4">
                Si vous avez des questions ou des préoccupations concernant cette politique de confidentialité ou nos pratiques de données, veuillez nous contacter à <a href="contact" class="text-blue-500 underline">contact@allomanege.com</a>.
            </p>

            <p class="mb-4">
                En utilisant nos services, vous reconnaissez avoir lu et compris cette politique de confidentialité.
            </p>
        </div>
    </section>
@endsection
