@extends('layouts.appsecond')
@section('title', 'Contact')
@section('content')
<section class="bg-custom-blue2 py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Div pour l'erreur de chargement de la page -->
        <div class="text-white p-8 mb-8 flex flex-col items-center">
            <h2 class="text-4xl font-semibold mb-4">CONTACT</h2>
           
            
            <!-- SVG -->
            <div class="flex items-center mt-4">
                <!-- Premier SVG et paragraphe -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white mr-2">
                    <path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                </svg>
                <p class="text-white">HOME</p>
                <!-- Deuxième SVG et paragraphe -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white ml-4 mr-2">
                    <path d="m19 12-7-6v5H6v2h6v5z"/>
                </svg>
                <p class="text-white">CONTACT</p>
            </div>
        </div>
        
    </div>
</section>
<form action="/contact/send" method="POST" class="max-w-4xl mx-auto my-12 px-4">
    @csrf
    <div class="lg:flex lg:justify-between lg:items-start">
        <div class="mt-4 lg:w-1/2 lg:pr-4 mb-4">
            <label for="nom" class="block mb-2">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder='Entrez votre nom' required class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
            <label for="prenom" class="block mb-2">Prénom :</label>
            <input type="text" id="prenom" name="prenom"placeholder='Entrez votre prénom' required class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
            <label for="entreprise" class="block mb-2">Entreprise :</label>
            <input type="text" id="entreprise" name="entreprise" placeholder="Entrez votre nom d'entreprise" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
            <label for="email" class="block mb-2">Email :</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre E-mail" required class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
        </div>
        <div class="lg:w-1/2 lg:pl-4 mb-4">
                <option value=""></option>
            </select>
            <label for="telephone" class="block mb-2">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" placeholder='Entrez votre numéro de téléphone' required class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2">
            <label for="message" class="block mb-2">Votre message :</label>
            <textarea id="message" name="message" placeholder='Entrez votre message' required class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" rows="7"></textarea>
        </div>
    </div>
    <div class="flex justify-center mt-4">
        <button type="submit" class="bg-custom-blue-header text-white py-2 px-4 rounded-md">Envoyer</button>
    </div>
</form>





    @endsection