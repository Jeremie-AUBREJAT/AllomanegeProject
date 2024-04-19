@extends('layouts.appsecond')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Catalogue de nos produits</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($pictures as $picture)
        <div class="container border p-4">
           
            <img src="/images/{{$picture->image}}"  class="mb-2">
            
        </div>
        @endforeach
    </div>
</div>
<div class="flex justify-center">
    <a href="/picture/create" class="block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer un produit</a>
</div>
@endsection
