@extends('layouts.appsecond')

@section('content')
{{-- test reservation --}}
<h2 class="text-xl mb-4">Réservations associées</h2>
<div class="bg-white p-4 rounded-lg shadow-md mb-8">
    @foreach ($reservations as $reservation)
        <div class="p-4 mb-4 bg-gray-100 rounded-lg shadow-md flex justify-between items-center">
            <div>
                <p><strong>Date de début:</strong>
                    {{ \Carbon\Carbon::parse($reservation->debut_date)->format('d/m/Y') }}</p>
                <p><strong>Date de fin:</strong> {{ \Carbon\Carbon::parse($reservation->fin_date)->format('d/m/Y') }}
                </p>
                <p><strong>Statut:</strong> {{ $reservation->status }}</p>
            </div>
            @if(Auth::check() && Auth::user()->role === 'Super_admin')
    <div class="w-full my-auto flex justify">
        <a href='/reservation/update/{{ $reservation->id }}'
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
        <form method="POST" action="{{ url('reservation/delete/' . $reservation->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Supprimer</button>
        </form>
    </div>
@endif
        </div>
    @endforeach
</div>
<div class="flex justify-center">
    
    <a href="/carousel/{{$carousel->id}}/reservations" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Voir les réservations
    </a>
    
    <div class="w-2/3 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl mb-4">Modification de {{ $carousel->name }}</h1>

        <form method="POST" action="{{ url('carousel/update/'.$carousel->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Colonne gauche pour les champs -->
                <div>
                    <!-- Champ nom -->
                    <div class="mb-4">
                        <label for="name" class="block mb-2">Nom :</label>
                        <input type="text" name="name" id="name" value="{{ $carousel->name }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('name')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ taille -->
                    <div class="mb-4">
                        <label for="size" class="block mb-2">Taille :</label>
                        <input type="text" name="size" id="size" value="{{ $carousel->size }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('size')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ poid -->
                    <div class="mb-4">
                        <label for="weight" class="block mb-2">Poid :</label>
                        <input type="text" name="weight" id="weight" value="{{ $carousel->weight }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('weight')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ puissance en Kwatt -->
                    <div class="mb-4">
                        <label for="watt_power" class="block mb-2">Puissance en Kwatt :</label>
                        <input type="text" name="watt_power" id="watt_power" value="{{ $carousel->watt_power }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('watt_power')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ localisation du manèges -->
                    <div class="mb-4">
                        <label for="localization" class="block mb-2">Localisation :</label>
                        <input type="text" name="localization" id="localization" value="{{ $carousel->localization }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('localization')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ temps d'installation -->
                    <div class="mb-4">
                        <label for="install_time" class="block mb-2">Temps d'installation en heure "s" :</label>
                        <input type="text" name="install_time" id="install_time" value="{{ $carousel->install_time }}" class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('install_time')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ prix -->
                    <div class="mb-4">
                        <label for="price" class="block mb-2">Prix :</label>
                        <input type="number" value="{{ $carousel->price }}" name="price" id="price" step="0.01" required class="border rounded-md px-3 py-2 w-full">
                    </div>
                    @error('price')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ description -->
                    <div class="mb-4">
                        <label for="description" class="block mb-2">Description :</label>
                        <textarea name="description" id="description" required class="border rounded-md px-3 py-2 w-full">{{ $carousel->description }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    <!-- Champ catégorie -->
                    <div class="mb-4">
                        <label for="category" class="block mb-2">Catégorie :</label>
                        <select name="category" id="category" required class="border rounded-md px-3 py-2 w-full">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $carousel->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <p class="text-red-500 bg-red-100 p-2 rounded">{{ $message }}</p>
                    @enderror

                    @if (Auth::user()->role === 'Super_admin')
                        <select name="status" class="form-control mb-4">
                            @foreach (config('enumStatus.status') as $key => $value)
                                <option value="{{ $key }}" {{ $carousel->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <!-- Colonne droite pour les images -->
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($carousel->carouselPictureMany as $picture)
                            <div class="mb-4">
                                <label for="imageUpdate{{ $picture->id }}" class="block mb-2">Modifier Image {{ $loop->index + 1 }} :</label>
                                <input type="file" name="imageUpdate[]" id="imageUpdate{{ $picture->id }}" accept="image/*" class="border rounded-md px-3 py-2 w-full">
                                <p class="mt-2">Image actuelle :</p>
                                @if (!empty($picture->images))
                                    <img src="{{ asset($picture->images) }}" alt="Image du carrousel" class="mt-2 w-full h-auto">
                                    <input type="hidden" name="current_image[]" value="{{ $picture->images }}">
                                @else
                                    <p>Aucune image disponible</p>
                                @endif
                                <div class="mt-2">
                                    <input type="checkbox" name="delete_image_id[]" value="{{ $picture->id }}" id="deleteImage{{ $picture->id }}">
                                    <label for="deleteImage{{ $picture->id }}">Supprimer cette image</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="newImages" class="block mb-2">Ajouter de nouvelles images :</label>
                        <input type="file" name="newImages[]" id="newImages" accept="image/*" multiple class="border rounded-md px-3 py-2 w-full">
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Enregistrer</button>
        </form>
        <a href="/carousel/view" class="block mt-4 bg-blue-900 hover:bg-blue-800 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour catalogue manèges</a>
    </div>
</div>

<div class="flex justify-center mt-8">
    <form method="post" action="{{ url('/carousel/' . $carousel->id) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 active:bg-red-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Supprimer</button>
    </form>
</div>
    
@endsection
