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
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .file-upload {
            text-align: center;
            margin-bottom: 20px;
        }

        .file-upload img {
            width: 150px;
            cursor: pointer;
        }

        input[type="file"] {
            display: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Add this in your HTML file, preferably in the <head> section -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/home') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
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
                            <form method="GET" class="form" action="{{ route('links.make') }}">
                                <div class="box-saerch"><input type="text" name="url" class="search"
                                        placeholder="Url ni qisqartirish"> <button type="submit"
                                        class="search-button"><img src="img/link_in_bio.png" width="16"
                                            height="16s" alt=""></button></div>
                            </form>
                        </li>
                        <li class="site-header__item">
                            <a href="#" class="site-header__link">Kirish</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- site-hiro -->
            <div class="hiro">
                <div class="site-hiro container">
                    <ul class="site-hiro__lit">

                        <form id="uploadForm" action="{{ route('links.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <li class="site-hiro__item">
                                <label for="file-input" class="site-hiro__link">
                                    <img src="./img/upload.png" width="150" alt="">
                                </label>
                                <input type="file" id="file-input" name="file" style="display: none;">
                            </li>
                        </form>
                        

                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/transparent.png" width="150"
                                    alt=""></a>
                        </li>
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/qr_code.png" width="150"
                                    alt=""></a>
                        </li>
                        <li class="site-hiro__item">
                            <a href="#" class="site-hiro__link"><img src="./img/link_in_bio.png" width="150"
                                    alt=""></a>
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
        $(document).ready(function () {
            $('#file-input').change(function () {
                // Submit the form when a file is selected
                $('#uploadForm').submit();
            });
        });
    </script>
    
</body>

</html>
