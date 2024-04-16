<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/carouseldetails.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allo Manège</title>
</head>
<body>
<header class="">  
    <nav class="bg-custom-blue-header flex items-center justify-between px-8 py-4">
        <div class="flex items-center gap-4">
            <div class="logo">
                <a href="/"><img src="{{ asset('images/logo.jpg') }}" alt="logo" class="w-32"></a>
            </div>
            <ul class="flex items-center gap-4">
                <li>
                    <details class="relative inline-block text-left">
                        <summary class="w-full bg-custom-blue-header border border-transparent shadow-sm py-4 px-4 inline-flex justify-center text-xl font-semibold text-white hover:bg-amber-600 focus:outline-none active:bg-orange-700">
                            MANÈGES
                        </summary>
                        <div class="absolute left-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-blue-500 shadow-lg ring-1 ring-white ring-opacity-5 hover:bg-blue-600 focus:outline-none">
                            <ul class="list-none p-2 flex flex-col justify-center">
                            </ul>
                        </div>
                    </details>
                </li>
                <li ><a class="w-full bg-custom-blue-header border border-transparent shadow-sm py-4 px-4 inline-flex justify-center text-xl font-semibold text-white hover:bg-amber-600 focus:outline-none active:bg-orange-700" href="/Réservation">RÉSERVATION</a></li>
                <li><a class="w-full bg-custom-blue-header border border-transparent shadow-sm py-4 px-4 inline-flex justify-center text-xl font-semibold text-white hover:bg-amber-600 focus:outline-none active:bg-orange-700" href="/a_propos">A PROPOS</a></li>
                <li><a class="w-full bg-custom-blue-header border border-transparent shadow-sm py-4 px-4 inline-flex justify-center text-xl font-semibold text-white hover:bg-amber-600 focus:outline-none active:bg-orange-700" href="/contact">CONTACT</a></li>
            </ul>
        </div>
        <div class="buttons flex gap-4">
            <div class="rounded-lg border border-gray-300 bg-white shadow-md p-4 flex flex-col">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg>
            </div>
            <details class="rounded-lg border border-gray-300 bg-white shadow-md p-4 flex flex-col">
                <summary class="flex items-center gap-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
                </summary>
                <div class="absolute right-0 z-10 mt-6 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-white ring-opacity-5 hover:bg-white focus:outline-none">
                    <ul class="list-none p-2 flex flex-col justify-center">
                        <li><a class="block p-4 text-gray-800 hover:bg-gray-50 hover:text-black" href="">S'inscrire</a></li>
                        <li><a class="block p-4 text-gray-800 hover:bg-gray-50 hover:text-black" href="">Se connecter</a></li>
                    </ul>
                </div>
            </details>
        </div>      
    </nav>
    
</header>
 
    <main>
    @yield('content')
    </main>

    
    <footer>
        <div class="mt-8 mx-8">&copy;2024 Allo Manège </div>
    </footer>
</body>
</html>