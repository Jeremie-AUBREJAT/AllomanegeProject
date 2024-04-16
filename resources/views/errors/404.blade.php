@extends('layouts.appsecond')

@section('content')
<section class="bg-custom-blue2 py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Div pour l'erreur de chargement de la page -->
        <div class="text-white p-8 mb-8 flex flex-col items-center">
            <h2 class="text-4xl font-semibold mb-4">Erreur de chargement de la page</h2>
            <p class="text-lg">Nous sommes désolés, la page que vous recherchez semble avoir rencontré une erreur de chargement. Veuillez réessayer plus tard.</p>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white mr-2">
                    <path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"/>
                </svg>
                <p class="text-white">HOME</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-white ml-4 mr-2">
                    <path d="m19 12-7-6v5H6v2h6v5z"/>
                </svg>
                <p class="text-white">ERREUR</p>
            </div>
        </div>
        
    </div>
    
</section>
<section class="py-12 px-4 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
    <h2 class="text-custom-font-blue text-9xl font-semibold mb-4">404</h2>
    <p class="text-custom-font-blue text-4xl font-semibold mb-8">Page non trouvée</p>
    <p class="text-lg mb-8">La page que vous recherchez semble introuvable.</p>
    <a href="/" class="inline-block bg-custom-orange hover:bg-orange-600 text-white font-bold py-2 px-4">Retour à la page d'accueil</a>
</div>
</div>
</section>
@endsection