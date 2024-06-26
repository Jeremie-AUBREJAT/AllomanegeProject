@extends('layouts.appsecond')
@section('title', 'Manèges')
@section('content')
    <!--1er section-->
    <section class="bg-custom-blue2 py-12 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">

            <div class="text-white p-8 mb-8 flex flex-col items-center">
                <h2 class="text-4xl font-semibold mb-4">MANÈGES</h2>
                <div class="flex items-center mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current text-white mr-2">
                        <path
                            d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z" />
                    </svg>
                    <p class="text-white">HOME</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current text-white ml-4 mr-2">
                        <path d="m19 12-7-6v5H6v2h6v5z" />
                    </svg>
                    <p class="text-white">MANÈGES</p>
                </div>
            </div>
           
        </div>
    </section>
    <section class="py-8 mt-16">
        <div class="container mx-auto px-4">

            <div class="flex flex-wrap justify-start gap-4 mb-16">
                
                <div class="filter ml-8 mb-4 lg:mb-0 lg:mr-8">
                    <label for="price" class="mr-2 text-xl text-custom-blue-header font-semibold">Prix :</label>
                    <select id="price" class="border p- rounded pr-8">
                        <option value="" disabled selected hidden>Trier par prix</option>
                        <option value="lowToHigh">Du moins cher au plus cher</option>
                        <option value="highToLow">Du plus cher au moins cher</option>
                        
                    </select>
                </div>
               
                <div class="filter mb-4 lg:mb-0 lg:mr-8">
                    <label for="category" class="mr-2 text-xl text-custom-blue-header font-semibold">Catégorie :</label>
                    <select id="category-filter2" class="border p-2 rounded pr-8">
                        {{-- <option value="" disabled selected hidden>Trier par catégorie</option> --}}
                        <option value="allcategories" class="category-option">Toutes les catégories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}" class="category-option">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter flex items-center">
                    <label for="location" class="mr-2 text-xl text-custom-blue-header font-semibold">Position géographique
                        :</label>
                    <input type="range" id="location" name="location" min="0" max="800" step="1" value="2000"
                        class="w-40 lg:w-auto">
                    <output for="location" id="locationValue" class="ml-2">0 km</output>
                </div>
                <div class="filter ml-8 mb-4 lg:mb-0 lg:mr-8">
                    <a href="/manèges" class="border p-2 rounded-md bg-custom-blue-header text-white font font-semibold">Supprimer les filtres</a>
                    
                </div>
            </div>
            
            <section class="container mx-auto px-4 py-8 mt-16">
                <div id="carousel-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($carousels as $carousel)
                        <div class="carousel bg-white rounded-lg shadow-md p-4 mb-8" data-latitude="{{$carousel->latitude}}" data-longitude="{{$carousel->longitude}}">
                            @foreach ($carousel->reservations as $reservation)
                            <div class="carousel-reservation" data-date-start="{{ $reservation->debut_date }}" data-date-end="{{ $reservation->fin_date }}"></div>
                            
                            @endforeach
                            @if ($carousel->carouselPictureMany->isNotEmpty())
                                <img src="{{ asset($carousel->carouselPictureMany->first()->images) }}" alt="Image 1"
                                    class="w-full h-48 object-contain mb-2">
                            @else
                                <p>Aucune image disponible</p>
                            @endif
                            
                            <h3 class="text-custom-blue-header text-2xl font-semibold mb-2" id="name" name="name">
                                {{ $carousel->name }}</h3>
                            <div class="flex items-center mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 0 24 24"
                                    style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                                    <path
                                        d="M12 2C7.589 2 4 5.589 4 9.995 3.971 16.44 11.696 21.784 12 22c0 0 8.029-5.56 8-12 0-4.411-3.589-8-8-8zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                                    </path>
                                </svg>
                                <p class="text-custom-blue-header font-semibold text-lg" name="localization">
                                    {{ $carousel->city }} {{ $carousel->postal_code }}</p>
                            </div>
                            <p class="text-custom-blue-header font-semibold text-lg mb-2 mt-4"name="category">
                                {{$carousel->category->name}}</p>
                            <p class="text-custom-blue-header font-semibold text-lg mb-2 mt-4"name="price">
                                {{ $carousel->price }} €</p>
                            <a href="/manège/détails/{{ $carousel->id }}"
                                class="mt-12 bg-custom-blue-header hover:bg-blue-600 active:bg-custom-blue-header text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Détails</a>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8 flex justify-center pagination-hidden pagination">
                    {{ $carousels->appends(request()->except('page'))->links() }}
                </div>
            </section>
        </div>
    </section>
@endsection
