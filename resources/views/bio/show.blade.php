<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/bio.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
            integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @endpush
    <div class="bio-form">
        <div class="container"> <!-- open container -->
            <div class="row"> <!--  open row -->
                <div id="form-tagline" class="col-md-4">
                    <div class="form-tagline">
                        <i class="fa fa-envelope fa-5x"></i>
                        <h1 id="name-out">{{ $bio->title }}</h1>
                        <p id="description" class="lead">We really value your opinion</p>
                    </div>
                </div>
                <div id="form-content" class="col-md-8">
                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url({{ asset($bio->avatar_icon) }});">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <section class="bio mb-4 text-center">
                            <p>
                            <h1><i class="fa fa-user me-3"></i>{{ $bio->title }}</h1>
                            </p>
                            <p>{{ $bio->kalta()->first()->description }}</p>
                        </section>
                    </div>
                    @isset($bio->instagram)
                        <a href="{{ asset($bio->instagram) }}"
                            class="link-tab d-flex align-items-center p-3 mb-3 text-decoration-none text-dark bg-light border rounded">
                            <i class="fab fa-instagram me-3" aria-hidden="true"></i>
                            <span class="flex-grow-1 text-center">Instagram</span>
                        </a>
                    @endisset

                    @isset($bio->telegram)
                        <a href="{{ asset($bio->telegram) }}"
                            class="link-tab d-flex align-items-center p-3 mb-3 text-decoration-none text-dark bg-light border rounded">
                            <i class="fab fa-telegram me-3" aria-hidden="true"></i>
                            <span class="flex-grow-1 text-center">Telegram</span>
                        </a>
                    @endisset

                    @isset($bio->twitter)
                        <a href="{{ asset($bio->twitter) }}"
                            class="link-tab d-flex align-items-center p-3 mb-3 text-decoration-none text-dark bg-light border rounded">
                            <i class="fab fa-twitter me-3" aria-hidden="true"></i>
                            <span class="flex-grow-1 text-center">Twitter</span>
                        </a>
                    @endisset

                    @isset($bio->blog)
                        <a href="{{ asset($bio->blog) }}"
                            class="link-tab d-flex align-items-center p-3 mb-3 text-decoration-none text-dark bg-light border rounded">
                            <i class="fab fa-blogger me-3" aria-hidden="true"></i>
                            <span class="flex-grow-1 text-center">Blog</span>
                        </a>
                    @endisset
                    <hr>
                </div> <!-- close form content div -->
            </div> <!-- close row -->
        </div><!--  close container -->
    </div>
</x-app-layout>
