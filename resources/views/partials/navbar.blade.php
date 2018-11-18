 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Mtalii Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">Back Home</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard/index') }}">Dashboard</a>
      </li>

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              companies
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ url('/companies/create') }}">new company</a>
            @if(Auth::user()->companies->isEmpty())
            @else
            @foreach (Auth::user()->companies as $company)
            <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('/companies/'.$company->id) }}">{{ $company->name }}</a>
            @endforeach
            @endif
          </div>
        </li>

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->email }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/bucketlist') }}">Bucketlist</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('deleteAccount')}}">Delete account</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
          </div>
        </li>
    </ul>
  </div>
</nav>
