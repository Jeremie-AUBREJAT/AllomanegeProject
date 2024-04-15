@extends('layouts.appfirst')

@section('content')
<body>
    <section class="Formulaire flex flex-wrap bg-custom-blue z-0">
        <!-- Container formulaire recherche -->
        <div class="w-full md:w-1/2">
            <div class="container1 mx-auto p-8 bg-custom-orange">
                <div class="flex justify-center mb-8">
                    <img src="votre-logo.png" alt="Logo" class="h-16">
                </div>
                <form class="px-24 pt-6 pb-8 mb-4 bg-custom-orange">
                    <div class="mb-4">
                        <label class="block text-black text-xl font-semibold mb-2" for="localisation">Localisation</label>
                        <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="localisation" type="text" placeholder="Entrez votre localisation">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black text-xl font-semibold mb-2" for="date">Date</label>
                        <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="date" type="date">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black text-xl font-semibold mb-2" for="taille">Taille Manège</label>
                        <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="taille" type="text" placeholder="Entrez la taille du manège">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black text-xl font-semibold mb-2" for="prix">Prix</label>
                        <input class="slider" id="prix" type="range" min="0" max="100" step="1">
                        <p class="text-black mt-2" id="prix-value">0 €</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-white hover:bg-blue-950 hover:text-white text-black font-bold py-2 px-4 mx-auto rounded-full focus:outline-none focus:shadow-outline" type="button">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Container 2 Détails -->
        <div class="w-full h-full md:w-1/2 my-auto bg-custom-blue">
            <div class="container2 mx-auto p-4 h-full ">
               
                <h1 class="text-white text-3xl font-bold text-center mb-4">Bienvenue sur notre site de location de manèges</h1>

               
                <p class="text-lg text-white leading-relaxed mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae efficitur neque. Sed in eros eu velit varius tempus. Cras ullamcorper, dolor non tempor congue, velit neque elementum sem, ut semper justo libero ut lorem.</p>

                
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
                <div class="hidden lg:block border-l-[24.5vw] border-l-white border-r-[25vw] border-r-white border-t-[150px] border-t-custom-orange">
                </div>
            </div>
        </div>
    </section>
    <!-- section Services -->
    <section class="Services container mx-auto p-4 mt-36">
        
        <h2 class="text-6xl font-bold text-center mb-8 text-custom-font-blue">SERVICES</h2>

        
        <div class="flex flex-wrap justify-center -mx-4 mt-52">
            <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                <div class="bg-white shadow-md rounded-full p-4">
                    <h3 class="text-xl font-bold text-center mb-4">Service 2</h3>
                    <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae efficitur neque.</p>
                </div>
            </div>

      
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-white shadow-md rounded-full p-4">
                    <h3 class="text-xl font-bold text-center mb-4">Service 1</h3>
                    <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae efficitur neque.</p>
                </div>
            </div>

           
            <div class="w-full md:w-1/3 px-4 mb-8 mt-16">
                <div class="bg-white shadow-md rounded-full p-4">
                    <h3 class="text-xl font-bold text-center mb-4">Service 3</h3>
                    <p class="text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae efficitur neque.</p>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection