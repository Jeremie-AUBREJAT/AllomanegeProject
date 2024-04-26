@extends('layouts.appsecond')

@section('content')
{{-- <div>
    <h1 class="text-2xl mb-4">Catalogue de nos manèges</h1>
    <div class="grid grid-cols-3 gap-4">
        {{-- @foreach ($carousels->zip($categories) as [$carousel, $category]) --}}
        {{-- @foreach ($carousels as $carousel)
        <div class="container border p-4">
            <p class="font-bold">{{$carousel->name}}</p>
            <p class="mb-2">Taille : {{$carousel->size}}</p>
            <p class="mb-2">Poid : {{$carousel->weight}}</p>
            <p class="mb-2">Puissance en Kwatt : {{$carousel->watt_power}}</p>
            <p class="mb-2">Temps d' installation en heure "s" : {{$carousel->install_time}}</p>
            <p class="mb-2">Description : {{$carousel->description}}</p>
            <p class="mb-2">Localisation : {{$carousel->localization}}</p>
            <p class="mb-2">Prix : {{$carousel->price}}</p>
            @if ($carousel->category)
            <p class="mb-2">Catégorie : {{$carousel->category->name}}</p>
            @else
                <p class="mb-2">Catégorie non définie</p>
            @endif
            @if ($carousel->carouselPictureMany->isNotEmpty())
            @foreach ($carousel->carouselPictureMany as $picture)
                <img src="{{ asset($picture->images) }}" alt="Image du carousel">
            @endforeach
            @endif

            <a href="/carousel/update/{{$carousel->id}}" class="mt-12 bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
        </div>
        
        @endforeach
    </div>
</div>


<div class="flex justify-center">
    <a href="/carousel/create" class="block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer un Manège</a>
</div> --}}
{{-- test --}}
<section class="container mx-auto px-4 py-8 mt-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($carousels as $carousel)  
        <div class="bg-white rounded-lg shadow-md p-4">
            @if ($carousel->carouselPictureMany->isNotEmpty())
                <img src="{{ asset($carousel->carouselPictureMany->first()->images) }}" alt="Image 1" class="w-full h-48 object-cover mb-2">
            @else
                <p>Aucune image disponible</p>
            @endif
            
            <h3 class="text-custom-blue-header text-2xl font-semibold mb-2" name="name">{{$carousel->name}}</h3>
            <div class="flex items-center mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 0 24 24" style="fill: rgba(1, 16, 90, 1);transform: ;msFilter:;">
                <path d="M12 2C7.589 2 4 5.589 4 9.995 3.971 16.44 11.696 21.784 12 22c0 0 8.029-5.56 8-12 0-4.411-3.589-8-8-8zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"></path>
            </svg><p class="text-custom-blue-header font-semibold text-lg" name="localization">{{$carousel->localization}}</p></div>
            <p class="text-custom-blue-header font-semibold text-lg mb-2 mt-4"name="price">{{$carousel->price}} €</p>
            <a href="/carousel/update/{{$carousel->id}}" class="mt-12 bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
        </div>
        @endforeach
    </div>
</section>
<div class="flex justify-center m-8">
    <a href="/carousel/create" class="block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer un Manège</a>
</div>



{{-- fin test --}}
@endsection
