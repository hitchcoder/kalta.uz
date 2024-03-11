<x-app-layout>
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
                                <a href="{{route('bio.create')}}" class="site-hiro__link"><img src="./img/link_in_bio.png"
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
    
</x-app-layout>