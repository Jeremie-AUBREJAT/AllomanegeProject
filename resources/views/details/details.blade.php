@extends('layouts.appsecond')

@section('content')
    <!--1er section-->
    <section class="bg-custom-blue2 py-12 px-4 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">

            <div class="text-white p-8 mb-8 flex flex-col items-center">
                <h2 class="text-4xl font-semibold mb-4">DETAILS</h2>
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
                    <p class="text-white">DETAILS</p>
                </div>
            </div>

        </div>
    </section>
    <!-- 2eme section -->
    <section id="50" class="flex flex-wrap justify-between mt-16 text-custom-blue-header">

        <!-- Div de Gauche -->
        <div class="w-full lg:w-2/3 p-4 relative mt-8">
            <h2 class="text-4xl font-bold mb-4">{{ $carousel->name }}</h2>
            <p class="text-custom-blue-header text-xl mb-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 0 24 24"
                    style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                    <path
                        d="M12 2C7.589 2 4 5.589 4 9.995 3.971 16.44 11.696 21.784 12 22c0 0 8.029-5.56 8-12 0-4.411-3.589-8-8-8zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                    </path>
                </svg>
                {{ $carousel->city }}
            </p>
            <div class="flex items-center bg-gray-100 p-6 my-8 w-10/12">
                <label for="prix" class="text-custom-blue-header text-xl mr-4">Prix : </label>
                <p class="mr-4 text-custom-orange">{{ $carousel->price }}€</p>
                <div class="flex ml-auto items-center">
                    <span class="stars-container flex ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1l2.5 6.5H18l-5 4.5 1.5 6-5-4.5-5 4.5 1.5-6-5-4.5h5.5L10 1z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1l2.5 6.5H18l-5 4.5 1.5 6-5-4.5-5 4.5 1.5-6-5-4.5h5.5L10 1z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1l2.5 6.5H18l-5 4.5 1.5 6-5-4.5-5 4.5 1.5-6-5-4.5h5.5L10 1z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1l2.5 6.5H18l-5 4.5 1.5 6-5-4.5-5 4.5 1.5-6-5-4.5h5.5L10 1z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1l2.5 6.5H18l-5 4.5 1.5 6-5-4.5-5 4.5 1.5-6-5-4.5h5.5L10 1z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>

            <div id="carousel" class="relative">
                @foreach ($carousel->carouselPictureMany as $picture)
                    @if ($loop->first)
                        <div class="w-10/12 mb-4 rounded-lg border-2 border-gray-300 h-320 sm:h-320 md:h-480 lg:h-480 xl:h-480 "
                            style="overflow: hidden;">
                            <img src="{{ asset($picture->images) }}" alt="{{ $carousel->description }}"
                                class="w-full h-full object-contain" style="object-fit: contain;">
                        </div>
                    @endif
                @endforeach

            </div>

            <div id="thumbnails" class="flex space-x-2 ml-1">
                @foreach ($carousel->carouselPictureMany as $picture)
                    @unless ($loop->first)
                            <div class="w-1/5 mb-4 rounded-lg border-2 border-gray-300 h-64 sm:h-112 md:h-112 lg:h-112 xl:h-112"
                            style="overflow: hidden;">
                            <img src="{{ asset($picture->images) }}" alt="{{ $carousel->description }}"
                                class="w-full h-full object-contain" style="object-fit: contain;">
                        </div>
                    @endunless
                @endforeach
            </div>
            <div id="fullScreenImage"
                class="fixed z-10 top-0 left-0 w-full h-full bg-black bg-opacity-80 hidden flex justify-center items-center">
                {{-- <img src="image1.jpg" alt="Image en plein écran" class="max-w-3xl max-h-3xl"> --}}
            </div>



            <div class="w-full lg:w-2/3 py-4 mt-16">
                <h3 class="text-2xl font-bold mb-4">Description: </h3>
                <p class="text-gray-700 mb-4">{{ $carousel->description }}</p>

                <!-- Rectangle 1 -->
                <div class="flex justify-between">

                    <div class="flex flex-col items-center bg-gray-200 p-4 rounded-sm w-1/3 mr-2">
                        <p class="text-lg font-bold mb-2">Longeur </p>
                        <p>{{ $carousel->length }} m</p>
                    </div>
                    <div class="flex flex-col items-center bg-gray-200 p-4 rounded-sm w-1/3 mr-2">
                        <p class="text-lg font-bold mb-2">Largeur </p>
                        <p>{{ $carousel->width }} m</p>
                    </div>
                    <div class="flex flex-col items-center bg-gray-200 p-4 rounded-sm w-1/3 mr-2">
                        <p class="text-lg font-bold mb-2">Poids </p>
                        <p>{{ $carousel->weight }} T</p>
                    </div>
                    <!-- Rectangle 2 -->
                    <div class="flex flex-col items-center bg-gray-200 p-4 rounded-sm w-1/3 mx-2">
                        <p class="text-lg font-bold mb-2">Puissance</p>
                        <p>{{ $carousel->watt_power }} kWatt</p>
                    </div>

                    <!-- Rectangle 3 -->
                    <div class="flex flex-col items-center bg-gray-200 p-4 rounded-sm w-1/3 ml-2">
                        <p class="text-lg font-bold mb-2">Temps de montage</p>
                        <p>{{ $carousel->install_time }} H</p>
                    </div>
                    <div id="carousel-data" style="display: none;" data-carousel="{{ $carouselJson }}"></div>

                </div>
            </div>

        </div>
        <!-- Div de droite -->
        <div class="w-full h-64 lg:w-1/3 p-4">
            <div class="z-0 lg:mt-2 pt-4 lg:mr-4">
                <livewire:reserve-calendar />
            </div>

            <!-- Google Maps??? -->

            <h3 class="font font-semibold text-custom-blue-header mt-12 text-xl">Carte des manèges</h3>
            <div id="map-container" class="w-full mt-4 border border-custom-blue-header shadow-lg"
                style="height: 400px; width: calc(100% - 20px);"> <!-- Ajustez la hauteur selon vos besoins -->
                <div id="map" class="w-full h-full z-0"></div>
            </div>
        </div>

    </section>

    <div class="flex justify-center my-16">
        <a href="/manèges"
            class="block bg-custom-blue-header hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Retour aux
            manèges</a>
    </div>
    </section>
@endsection
