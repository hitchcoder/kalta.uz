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
                        <div id="name-out"></div>
                        <h2>How Are We Doing?</h2>
                        <p id="description" class="lead">We really value your opinion</p>
                    </div>
                </div>

                <div id="form-content" class="col-md-8">

                    <form action="{{ route('bio.store') }}" method="POST" id="survey-form"> <!-- open form -->
                        @csrf
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <label for="imageUpload"></label>
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label id="name-label" class="control-label" for="name">*Name:</label>
                            </div>

                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon-name"><i
                                            class="fa fa-user"></i></span>
                                </div>
                                <input id="name-input" type="text" class="form-control"
                                    placeholder="Please Enter Your Name" name="name" required>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="control-label" for="comment">Comments:</label>
                            </div>

                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon-mail"><i
                                            class="fa fa-comment"></i></span>
                                </div>
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 submit-button">
                                <button type="submit" id="submit" class="btn btn-default" aria-pressed="true">Submit
                                    Form</button>
                            </div>
                        </div>

                    </form> <!-- close form -->

                </div> <!-- close form content div -->

            </div> <!-- close row -->
        </div><!--  close container -->
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            console.log('test');
            readURL(this);
        });

        $(document).ready(function() {
            $('#name-input').on('input', function() {
                var x = $(this).val();
                console.log(x);
                var log = document.getElementById('name-out');
                log.textContent = x;
            });

            $("#survey-form").submit(function(event) {
                event.preventDefault(); // Prevents the default form submission
                alert("Thank You For Your Feedback");
                document.getElementById("survey-form").reset();
            });
        });
    </script>
</x-app-layout>
