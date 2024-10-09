<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/bio.css') }}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
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
                <div id="form-header" class="col-12">
                    <h1 id="title">Link in bio form</h1>
                </div>
            </div> <!--  close row -->
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
                        <div class="input-group col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon-name"><i class="fa fa-user"></i>
                                    {{ $bio->title }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div> <!-- close form content div -->
            </div> <!-- close row -->
        </div><!--  close container -->
    </div>
</x-app-layout>
