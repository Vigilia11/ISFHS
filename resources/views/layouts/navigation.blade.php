<style>
    .navbar{
        z-index: 3;
    }
</style>
<nav class="navbar navbar-expand-md navbar-light shadow fixed-top z-3 bg-white" style="">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            ISFHS
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                @if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dormitory.index') }}">Dormitory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('canteen.index') }}">Canteen</a>
                </li>
                @if(Auth::user()->hasRole('facilitator'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('facility.index') }}">Facility</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notification.index') }}">Notification</a>
                </li>
                @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registration.create') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a href="{{ route('account.index') }}" class="nav-link">
                            {{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>