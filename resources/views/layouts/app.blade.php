<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allo Manège</title>
</head>
<body>
<header class="hidden sm:block">
    <nav class="flex items-center justify-between px-8 py-4">
        <div class="flex">
            <div class="facebook mr-4"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
            </a>
            </div>
            <div class="twitter mr-4"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>
            </a>
            </div>
            <div class="instagram mr-4"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path><circle cx="16.806" cy="7.207" r="1.078"></circle><path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path></svg>
            </a>
            </div>          
        </div>
        <div class="logo mx-auto">
            <a href="/"><img src="{{ asset('images/logoTransparent.png') }}" alt="logo" class="w-32"></a>
        </div>
    </nav>
    
    <nav class=" bg-blue-900 flex items-center xl:justify-between px-8 py-4 justify-around">
        
        <div class="navlinks navlinks h-24 text-white flex items-center gap-8">
            <ul class="flex items-center gap-4">
                <li>
                <details class="relative inline-block text-left">
                <summary class="w-full bg-blue-900 border border-transparent rounded-md shadow-sm py-4 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ">
                    Manèges
                </summary>
                <div class="absolute left-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-blue-500 shadow-lg ring-1 ring-white ring-opacity-5 hover:bg-blue-600 focus:outline-none">
                <ul class="list-none p-2 flex flex-col  justify-center">
                </ul>
                </div>
               
                </details>
                </li>
                <li ><a class="w-full bg-blue-900 border border-transparent rounded-md shadow-sm py-4 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 " href="/personaliser">Personnaliser</a></li>
                <li><a class="w-full bg-blue-900 border border-transparent rounded-md shadow-sm py-4 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 " href="/a_propos">A propos</a></li>
                <li><a class="w-full bg-blue-900 border border-transparent rounded-md shadow-sm py-4 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 " href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="buttons flex gap-4">
            <div class="rounded-lg border border-gray-300 bg-white shadow-md p-4 flex flex-col">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAQNJREFUSEvNlbEVwjAMRH96FmELGAM2oIAGemAAGuhYgDFgCxahh4gX5SmJEwuH8HCVF9t3ujvZzhh4ZAPj81OCp1Gzz79331BnFVgCwZ4Ct74kIYsmwLUAF5Jeoy0DVdNbRRuBKBAlqaPMsI1AbUolkH1v7K42VRWf2CSdt81xowqEPCVsza4sPHbQPgm7UX3MIplXm+Q8xFo2icCG7VVbWRfbZFV0hR2s3mORDdvTso07zKNAgLXCLpJgTl6CMXAHRsCjxqL/dE1l2ktwBJbABZgbBAE/AzPgBKzqEr0E9iqv7+mac71oUqVksA5UKbYsCnWH3L5NqgJPBwXXeC36X4IXzvoyGb3oUXcAAAAASUVORK5CYII="/>
            </div>
            <details class="rounded-lg border border-gray-300 bg-white shadow-md p-4 flex flex-col">
                <summary class="flex items-center gap-2 cursor-pointer">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATxJREFUSEu1VVsSwiAMpCdTT6aeTD2Zdjsss4QNrR/li2mTfSQQlnLyWk7GL0cIrqWUexWCPda7lPKp+8dM5IyAwASd4TzXn5YoI0AwVQMYAFBN9QSLMQOJI1BwgN52+qTxg5NIkAXHckUgzYMguh2a/K1qIwC/RzMK9lqBIaRzrQ5UhfuupIyNJaSQRrwHBMVMiuV03wdiTaLFrDxHCFAi4DRnmpQpdcRUGsWQAM43bEfQnYLaOJC45Y55J9SVKBIQON4PvXwxxpYo6wGSOS50bACknXeZS7jdrXTqYGhQTSKxK1F2ICwBAKILBdcJiljOIZbD3qPYJD0FSGRJsr6woRrbudobdpyk2cxXQTb233HNptIZysS9fRNmD46b+a7RIHVHdos98mSS6CJq6SQFppIjBDvvzfz36QQ/Wk1mGaOBMWUAAAAASUVORK5CYII="/>
                </summary>
                <div class="absolute right-0 z-10 mt-6 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-white ring-opacity-5 hover:bg-white focus:outline-none">
                <ul class="list-none p-2 flex flex-col  justify-center">
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

    
    <footer>&copy; </footer>
</body>
</html>