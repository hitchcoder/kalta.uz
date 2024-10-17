<nav class="header navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
        <a href="#" class="site-header__logo navbar-brand">
            <h2 class="logo text-light">Kalta<samp class="logo-color">.UZ</samp></h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
            aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Dashboard</a>
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
            <form method="POST" action="{{ route('shorts.make') }}">
                @csrf
                <input id="url" name="url" class="form-control " type="text"
                    placeholder="URLni qisqartirish" style="background-color: white !important;">
            </form>
            <ul class="navbar-nav mb-2 mb-sm-0">
                <li class="nav-item site-header__item">
                    <a class=" site-header__link" href="#">Kirish</a>
                </li>
            </ul>
        </div>
    </div>
</nav>