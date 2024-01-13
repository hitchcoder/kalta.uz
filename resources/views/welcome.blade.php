<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kalta.uz</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
        {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="kalta">
                <!-- site-header -->
                <div class="header">
                    <div class="site-header container">
                        <a href="#" class="site-header__logo">
                            <h2 class="logo">Kalta<samp class="logo-color">.UZ</samp></h2>
                        </a>
                        <ul class="site-header__list">
                            <li class="site-header__item">
                                <form class="form" action="">
                                    <div class="box-saerch"><input type="search" class="search" placeholder="Url ni qisqartirish"> <button class="search-button"><img src="img/search.png" width="16" height="16s" alt=""></button></div>
                                </form>
                            </li>
                            <li class="site-header__item">
                                <a href="#" class="site-header__link">Krish</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- site-hiro -->
                <div class="hiro">
                 <div class="site-hiro container">
                    <ul class="site-hiro__lit">
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/upload.png" width="150" alt=""></a>
                        </li>
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/transparent.png" width="150" alt=""></a>
                        </li>
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/qr_code.png" width="150" alt=""></a>
                        </li>
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/link_in_bio.png" width="150" alt=""></a>
                        </li>
                    </ul>
                 </div>
                </div>
                <div class="main">
                    <div class="site-main container">
                        
                    </div>
                </div>
        </div>
        </div>
    <script src="js/main.js"></script>
    </body>
</html>
