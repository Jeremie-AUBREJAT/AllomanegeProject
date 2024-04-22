@extends('layouts.appsecond')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Catalogue de nos manèges</h1>
    <div class="grid grid-cols-3 gap-4">
        {{-- @foreach ($carousels->zip($categories) as [$carousel, $category]) --}}
        @foreach ($carousels as $carousel)
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
</div>

@endsection
