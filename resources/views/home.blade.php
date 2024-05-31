@extends('layouts.appfirst')

@section('content')

    <body>
        <section class="Formulaire flex flex-wrap bg-custom-blue z-0">
            <!-- Container formulaire recherche -->
            <div class="w-full md:w-1/2">
                <div class="container1 mx-auto p-8 bg-custom-orange">
                    <div class="flex justify-center mb-8">
                        <img src="/images/logo.png" alt="Logo" class="h-16">
                    </div>
                    <form class="px-24 pt-6 pb-8 mb-4 bg-custom-orange">
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2"
                                for="name">Nom du manège: </label>
                            <input
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Entrez votre recherche">
                        </div>
                        <div class="mb-4">
                            <label class="block text-black text-xl font-semibold mb-2" for="date-start">Date de début: </label>
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
                                    <option value="{{ $category->name }}" class="category-option">{{ $category->name }}</option>
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
                            <button
                               id="search-button" class="bg-white hover:bg-blue-950 hover:text-white text-black font-bold py-2 px-4 mx-auto rounded-full focus:outline-none focus:shadow-outline"
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

                    <h1 class="text-white text-3xl font-bold text-center mb-4">Bienvenue sur notre site de location de
                        manèges</h1>


                    <p class="text-lg text-white leading-relaxed mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Phasellus vitae efficitur neque. Sed in eros eu velit varius tempus. Cras ullamcorper, dolor
                        non tempor congue, velit neque elementum sem, ut semper justo libero ut lorem.</p>


                    <a href="" class="block mx-auto w-64">
                        <img src="lien-vers-votre-image.jpg" alt="Image Manèges" class="w-full rounded-lg shadow-lg">
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
        <section class="Services container mx-auto p-4 my-36">

            <h2 class="text-6xl font-bold text-center mb-8 text-custom-font-blue">SERVICES</h2>


            <div class="flex flex-wrap justify-center -mx-4 mt-52">
                <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                    <div class="bg-white shadow-md rounded-full p-4">
                        <h3 class="text-xl font-bold text-center mb-4">Service 2</h3>
                        <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus vitae efficitur neque.</p>
                    </div>
                </div>


                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-white shadow-md rounded-full p-4">
                        <h3 class="text-xl font-bold text-center mb-4">Service 1</h3>
                        <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus vitae efficitur neque.</p>
                    </div>
                </div>


                <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                    <div class="bg-white shadow-md rounded-full p-4">
                        <h3 class="text-xl font-bold text-center mb-4">Service 3</h3>
                        <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus vitae efficitur neque.</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="4 0 24 24" style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
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
                <a href="manèges" class="block bg-custom-blue-header hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Voir
                    plus</a>
            </div>
        </section>
        

    </body>
@endsection
