@extends('layouts.appfirst')

@section('content')

    <body>
        {{-- test rgpd --}}
    <!-- Modal for cookies and geolocation consent -->
   

    <!-- Modal pour le consentement aux cookies et à la géolocalisation -->
    <div id="consentModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Paramètres de confidentialité</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Nous utilisons des cookies pour améliorer votre expérience. Veuillez accepter les cookies fonctionnels pour continuer.</p>
                </div>
                <div class="mt-4">
                    <hr>
                    <p class="mt-4 text-sm text-gray-500">Souhaitez-vous activer la géolocalisation ?</p>
                    <button id="enableGeolocation" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">Activer la Géolocalisation</button>
                    <button id="disableGeolocation" class="mt-2 ml-2 px-4 py-2 bg-red-600 text-white rounded-md">Désactiver la Géolocalisation</button>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="saveSettings" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Enregistrer les paramètres</button>
                <button id="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Fermer</button>
            </div>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var openConsentModalButton = document.getElementById('openConsentModal');
            var consentModal = document.getElementById('consentModal');
    
            // Écouteur d'événement pour ouvrir la modal
            openConsentModalButton.addEventListener('click', function() {
                consentModal.classList.remove('hidden');
            });
    
            // Autres fonctionnalités JavaScript ici (comme la gestion de la géolocalisation)
            var enableGeolocation = document.getElementById('enableGeolocation');
            var disableGeolocation = document.getElementById('disableGeolocation');
            var saveSettings = document.getElementById('saveSettings');
            var closeModal = document.getElementById('closeModal');
            var watchId = null; // Variable pour stocker l'identifiant du suivi de géolocalisation
    
            // Fonction pour fermer le modal
            closeModal.addEventListener('click', function() {
                consentModal.classList.add('hidden');
            });
    
            // Fonction pour enregistrer les paramètres (exemple avec les cookies, à adapter à votre besoin)
            saveSettings.addEventListener('click', function() {
                // Exemple de gestion des cookies
                // Vous devez adapter cela à votre propre logique de consentement
                if (true /* Ajoutez votre condition pour accepter les cookies ici */) {
                    document.cookie = "acceptCookies=true; path=/; max-age=" + 60*60*24*30; // 30 jours
                    // Recharger la page pour appliquer les nouveaux paramètres
                    location.reload();
                } else {
                    document.cookie = "acceptCookies=false; path=/; max-age=" + 60*60*24*30; // 30 jours
                    // Supprimer les cookies de session
                    document.cookie = "laravel_session=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                    document.cookie = "XSRF-TOKEN=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                    // Recharger la page pour appliquer les nouveaux paramètres
                    location.reload();
                }
                // Fermer le modal après avoir enregistré les paramètres
                consentModal.classList.add('hidden');
            });
    
            // Fonction pour activer la géolocalisation
            enableGeolocation.addEventListener('click', function() {
                if (navigator.geolocation) {
                    watchId = navigator.geolocation.watchPosition(function(position) {
                        console.log('Géolocalisation activée :', position);
                        // Vous pouvez enregistrer la position ou effectuer d'autres actions ici
                    }, function(error) {
                        console.error('Erreur de géolocalisation :', error);
                    });
                } else {
                    console.error('La géolocalisation n\'est pas prise en charge par ce navigateur.');
                }
            });
    
            // Fonction pour désactiver la géolocalisation
            disableGeolocation.addEventListener('click', function() {
                if (watchId !== null) {
                    navigator.geolocation.clearWatch(watchId);
                    console.log('Géolocalisation désactivée');
                    watchId = null; // Réinitialiser l'identifiant de suivi
                } else {
                    console.warn('Aucun suivi de géolocalisation à désactiver.');
                }
            });
        });
        </script>
        <section class="Formulaire flex flex-wrap bg-custom-blue z-0">
            <!-- Container formulaire recherche -->
            <div class="w-full md:w-1/2">
                <div class="container1 mx-auto p-8 bg-custom-orange">
                    <div class="flex justify-center mb-8">
                        <img src="/images/logo.png" alt="Logo" class="h-16">
                    </div>
                    <form class="px-24 pt-6 pb-8 mb-4 bg-custom-orange">
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="name">Nom du manège: </label>
                            <input
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Entrez votre recherche">
                        </div>
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="date-start">Date de début:
                            </label>
                            <input
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                                id="date-start" type="date">
                        </div>
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="date-end">Date de fin: </label>
                            <input
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                                id="date-end" type="date">
                        </div>
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="taille">Catégories: </label>
                            <select id="category-filter" class="border p-2 rounded-full pr-8">
                                <option value="" disabled selected hidden>Trier par catégorie</option>
                                <option value="allcategories" class="category-option">Toutes les catégories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" class="category-option">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="prix">Prix: </label>
                            <input class="slider" id="prix" type="range" min="0" max="15000"
                                step="10">
                            <p class="text-black mt-2" id="prix-value">0 €</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <button id="search-button"
                                class="bg-white hover:bg-blue-950 hover:text-white text-black font-bold py-2 px-4 mx-auto rounded-full focus:outline-none focus:shadow-outline"
                                type="button">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Container 2 Détails -->
            <div class="w-full h-full md:w-1/2 my-auto bg-custom-blue">
                <div class="container2 mx-auto p-4 h-full ">

                    <h1 class="text-white text-3xl font-bold text-center mb-4 mt-4">Bienvenue sur notre site de location de
                        manèges</h1>


                    <p class="text-lg text-white leading-relaxed mb-6 px-6 ">Bienvenue sur <strong>Allo Manège</strong>,
                        votre solution de divertissement forain !

                        Vous organisez une fête, un événement d'entreprise, ou une kermesse et cherchez à offrir une
                        expérience inoubliable à vos invités ? Allo Manège est là pour vous ! Nous sommes spécialisés dans
                        la <strong>location de manèges de fête foraine</strong>.

                        Chez <strong>Allo Manège</strong>, nous comprenons que chaque événement est unique. C'est pourquoi
                        nous proposons une large gamme de <strong>manèges adaptés à tous les âges</strong> et à toutes les
                        occasions. Notre équipe professionnelle assure une installation rapide et sécurisée, vous permettant
                        de vous concentrer sur l'essentiel : profiter de la fête !

                        Découvrez notre catalogue en ligne et <strong>réservez le manège parfait</strong> pour votre
                        événement dès aujourd'hui. Avec Allo Manège, faites de chaque moment un souvenir magique et
                        mémorable.</p>

                    {{-- 
                    <a href="" class="block mx-auto w-64"> --}}
                    <img src="images/manege.webp" alt="Image Manèges" class="w-1/2 mx-auto rounded-lg shadow-2xl mt-12">
                    </a>
                </div>
            </div>

        </section>
        <!-- section triangle -->
        <section class="Triangle flex flex-wrap">
            <div class="w-full md:w-1/2">
                <!-- Triangle sous container1 -->
                <div class="bg-white z-10">
                    <div
                        class="hidden lg:block border-l-[24.5vw] border-l-white border-r-[25vw] border-r-white border-t-[150px] border-t-custom-orange">
                    </div>
                </div>
            </div>
        </section>
        <!-- section Services -->
        <section class="Services container mx-auto p-8 my-36">

            <h2 class="text-6xl font-bold text-center mb-8 text-custom-font-blue">SERVICES</h2>


            <div class="flex flex-wrap justify-center -mx-4 mt-52">
                <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                    <div class="bg-white shadow-md rounded-full border-solid border-2 border-custom-blue">
                        <div class="p-8">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                                    <path
                                        d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4 1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-center mb-4 text-custom-blue-header">Assistance rapide</h3>
                            <p class="font-semibold leading-relaxed text-center">Contactez-nous pour une expérience client
                                exceptionnelle !</p>
                        </div>
                    </div>
                </div>


                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-white shadow-md rounded-full border-solid border-2 border-custom-blue">
                        <div class="p-8">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                                    <path d="M16 12h2v4h-2z"></path>
                                    <path
                                        d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM5 5h13v2H5a1.001 1.001 0 0 1 0-2zm15 14H5.012C4.55 18.988 4 18.805 4 18V8.815c.314.113.647.185 1 .185h15v10z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-center mb-4 text-custom-blue-header">Forfait Tout Compris
                            </h3>
                            <p class="font-semibold leading-relaxed text-center">Location, Montage, Démontage, Techniciens.
                                Transformez votre fête avec Allo Manège !</p>
                        </div>
                    </div>
                </div>


                <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                    <div class="bg-white shadow-md rounded-full border-solid border-2 border-custom-blue">
                        <div class="p-8">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                                    <path
                                        d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-center mb-4 text-custom-blue-header">Réservation Rapide</h3>
                            <p class="font-semibold leading-relaxed text-center mt-10">Réservez votre
                                <strong>manège</strong> en quelques clics !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--section manèges -->
        <section class="container mx-auto px-4 py-8 mt-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($carousels as $carousel)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        @if ($carousel->carouselPictureMany->isNotEmpty())
                            <img src="{{ asset($carousel->carouselPictureMany->first()->images) }}" alt="Image 1"
                                class="w-full h-48 object-cover mb-2">
                        @else
                            <p>Aucune image disponible</p>
                        @endif

                        <h3 class="text-custom-blue-header text-2xl font-semibold mb-2" name="name">
                            {{ $carousel->name }}</h3>
                        <div class="flex items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 0 24 24"
                                style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                                <path
                                    d="M12 2C7.589 2 4 5.589 4 9.995 3.971 16.44 11.696 21.784 12 22c0 0 8.029-5.56 8-12 0-4.411-3.589-8-8-8zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                                </path>
                            </svg>
                            <p class="text-custom-blue-header font-semibold text-lg" name="localization">
                                {{ $carousel->localization }}</p>
                        </div>
                        <p class="text-custom-blue-header font-semibold text-lg mb-2 mt-4"name="price">
                            {{ $carousel->price }} €</p>
                        <a href="/manège/détails/{{ $carousel->id }}"
                            class="mt-12 bg-custom-blue-header hover:bg-blue-600 active:bg-custom-blue-header text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Détails</a>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-16">
                <a href="manèges"
                    class="block bg-custom-blue-header hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Voir
                    plus</a>
            </div>
        </section>


    </body>
@endsection
