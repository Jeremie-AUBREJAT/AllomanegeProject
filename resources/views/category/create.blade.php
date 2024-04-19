@extends('layouts.appsecond')
@section('content')

<form method="post" action="{{url('/category/create')}}" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nom :</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center justify-center">
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Créer une catégorie">
    </div>
</form>



@endsection