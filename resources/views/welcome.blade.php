<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to Kalta.uz, your go-to link in bio service. Shorten URLs, create QR codes, and manage your links efficiently. Sign up now!">

    <title>Kalta.uz</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>

    </style>
    <!-- Add this in your HTML file, preferably in the <head> section -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="antialiased" >
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        {{-- @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif --}}

        <div class="kalta">
            <nav class="header navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
                <div class="container-fluid">
                    <a href="#" class="site-header__logo navbar-brand">
                        <h2 class="logo text-light">Kalta<samp class="logo-color">.UZ</samp></h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample03">
                        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('index')}}">Dashboard</a>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">Dropdown</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                        <form>
                            <input class="form-control " type="text" placeholder="URLni qisqartirish"
                                aria-label="Search">
                        </form>
                        <ul class="navbar-nav mb-2 mb-sm-0">
                            <li class="nav-item site-header__item">
                                <a class=" site-header__link" href="#">Kirish</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="hiro">
                <div class="site-hiro container">
                    <ul class="site-hiro__lit">

                        <form class="pe-auto" id="uploadForm" action="{{ route('links.store') }}" method="post"
                            enctype="multipart/form-data" title="file upload">
                            @csrf
                            <li class="site-hiro__item pe-auto">
                                <label for="file-input" class="site-hiro__link">
                                    <img class="pe-auto" src="./img/upload.png" width="150" alt="Upload Icon">
                                </label>
                                <input type="file" id="file-input" name="file" style="display: none;">
                            </li>
                        </form>


                        <li class="site-hiro__item" title="code snippet">
                            <a href="#" class="site-hiro__link"><img src="./img/transparent.png"
                                    width="150" alt=""></a>
                        </li>
                        <li class="site-hiro__item" title="make qr code">
                            <a href="#" class="site-hiro__link"><img src="./img/qr_code.png" width="150"
                                    alt=""></a>
                        </li>
                        <li class="site-hiro__item" title="create your website">
                            <a href="#" class="site-hiro__link"><img src="./img/link_in_bio.png"
                                    width="150" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main">
                <div class="site-main container">
                    <ul>
                        @foreach ($links as $link)
                            <li> <a target="_blank" href="{{ route('links.show', $link->url) }}">
                                    {{ $link->linkable()->first()->long_url ?? $link->linkable()->first()->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#file-input').change(function() {
                // Submit the form when a file is selected
                $('#uploadForm').submit();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
</body>

</html>
