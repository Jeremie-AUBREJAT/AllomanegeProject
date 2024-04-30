@extends('layouts.appsecond')

@section('content')
<section class="container mx-auto px-8 py-8 mt-16">
    
        <!-- Section pour les utilisateurs -->
        <div>
            <h2 class="text-2xl font-semibold ml-4 my-4">Utilisateurs</h2>
            @foreach ($users as $user)
                @if ($user->role === 'User')
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center border border-gray-300 my-2">
                        <div class="flex-1 flex items-center">
                            <div>
                                <h3 class="text-custom-blue-header text-2xl font-semibold" name="name">{{ $user->name }} {{ $user->surname }}</h3>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->email }}</p>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->role }}</p>
                            </div>
                        </div>
                        <div>
                            <a href="/users/update/{{$user->id}}" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Section pour les administrateurs -->
        <div>
            <h2 class="text-2xl font-semibold ml-4 my-4"">Administrateurs</h2>
            @foreach ($users as $user)
                @if ($user->role === 'Admin')
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center border border-gray-300 my-2">
                        <div class="flex-1 flex items-center">
                            <div>
                                <h3 class="text-custom-blue-header text-2xl font-semibold" name="name">{{ $user->name }} {{ $user->surname }}</h3>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->email }}</p>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->role }}</p>
                            </div>
                        </div>
                        <div>
                            <a href="/users/update/{{$user->id}}" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Section pour les super administrateurs -->
        <div>
            <h2 class="text-2xl font-semibold ml-4 my-4">Super Administrateurs</h2>
            @foreach ($users as $user)
                @if ($user->role === 'Super_admin')
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center border border-gray-300 my-2">
                        <div class="flex-1 flex items-center">
                            <div>
                                <h3 class="text-custom-blue-header text-2xl font-semibold" name="name">{{ $user->name }} {{ $user->surname }}</h3>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->email }}</p>
                                <p class="text-custom-blue-header font-semibold text-lg">{{ $user->role }}</p>
                            </div>
                        </div>
                        <div>
                            <a href="/users/update/{{$user->id}}" class="bg-green-500 hover:bg-green-700 active:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    
</section>


@endsection
