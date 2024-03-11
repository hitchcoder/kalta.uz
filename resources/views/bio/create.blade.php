<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/bio.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    @endpush

    <div class="wrap">
        <div class="root"></div>
        <div class="links">
            <ul>
                <li><a href="#" class="link"><i class="fab fa-youtube"></i> See the latest video</a></li>
                <li><a href="#" class="link"><i class="fab fa-youtube"></i> Subscribe on YouTube channel</a>
                </li>
                <li><a href="#" class="link"><i class="fab fa-github"></i> Github</a></li>
                <li><a href="#" class="link"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                <li><a href="#" class="link"><i class="fab fa-codepen"></i> Codepen</a></li>
                <li><a href="#" class="link"><i class="fas fa-mobile-alt"></i> My website</a></li>
            </ul>
            <div class="card">
                <h3>Card</h3>
                <p>Just a card to display some information ...</p>
            </div>
        </div>

</x-app-layout>
