<nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
    <a class="navbar-brand" href="{{ url('/home') }}">Mtalii
        <p class="brand-caption">The smooth way to go places</p>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <img src="/imgs/collapse.svg">
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (\Illuminate\Support\Facades\Session::has('message'))
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="alert alert-success">
                    {{\Illuminate\Support\Facades\Session::remove('message')}}
                    </div>
                </li>
            </ul>
        @endif

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home')}}">HOME </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">ABOUT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/event') }}">EVENTS</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-warning btn-sm" href="{{route('login')}}">Login</a>
            </li>
        </ul>
    </div>
</nav>
