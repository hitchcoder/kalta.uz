<x-app-layout>

    @push('styles')
        <style>
            /* Just to play with animations */
            .copiedtext {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                text-align: center;
                opacity: 0;
                transform: translateY(-1em);
                color: #000;
                transition: all .500s;
            }

            .copied .copiedtext {
                opacity: 1;
                transform: translateY(-4em);
            }

            /* Some Generic styles */
            body {
                text-align: center;
                font-family: "Open Sans", Helvetica, Arial, sans-serif;
                color: #444;
                line-height: 1.6;
            }

            h1 {
                margin: 1.75em auto 1.25em;
            }

            button {
                font-size: 1em;
                font-family: "Open Sans", Helvetica, Arial, sans-serif;
            }

            [id="cleared"] {
                margin-top: 4em;
            }

            button {
                position: relative;
                padding: 8px 10px;
                border: 2px dotted black;
                font-size: 0.835em;
                text-transform: uppercase;
                letter-spacing: 0.125em;
                font-weight: bold;
                color: #000;
                background: #fff;
                transition: background .275s;
            }

            button:hover,
            button:focus {
                background: #EA2237;
                color: #fff;
                cursor: pointer;
            }
        </style>

        <script>
            function CopyToClipboard(containerid) {
                var btnCopy = document.getElementById("copy");
                var main = document.getElementById("maincontent");
                // Create a new textarea element and give it id='temp_element'
                var textarea = document.createElement("textarea");
                textarea.id = "temp_element";
                // Optional step to make less noise on the page, if any!
                textarea.style.height = 0;
                // Now append it to your page somewhere, I chose <body>
                document.body.appendChild(textarea);
                // Give our textarea a value of whatever inside the div of id=containerid
                textarea.value = document.getElementById(containerid).innerText;
                // Now copy whatever inside the textarea to clipboard
                var selector = document.querySelector("#temp_element");
                selector.select();
                document.execCommand("copy");
                // Remove the textarea
                document.body.removeChild(textarea);
                // Add copied text after click
                if (document.execCommand("copy")) {
                    btnCopy.classList.add("copied");

                    var temp = setInterval(function() {
                        btnCopy.classList.remove("copied");
                        clearInterval(temp);
                    }, 600);

                } else {
                    console.info("document.execCommand went wrong…");
                }

            }
        </script>
    @endpush
    <div>
        <h1>Your QR Code</h1>
        <p>Your link: <a href="{{$url}}">{{$url}}</a></p>
        <h5>Click a shortened link to copy: <button title="Copy promo code" id="copy" onClick="CopyToClipboard('to-copy')">
                <div id="to-copy">{{ asset($randomString) }}</div><span class="copiedtext"
                    aria-hidden="true">Copied</span>
            </button>
        <h5>
        <div>
            {!! $qrCode !!}
        </div>
    </div>

</x-app-layout>
