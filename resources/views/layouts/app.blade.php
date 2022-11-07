<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Blog Créative</title>
</head>
<body>
​
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center align-items-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">Blog Créative</span>
            </a>
​
            <ul class="nav align-items-baseline">
                <li class="nav-item me-2"><a href="/" class="nav-link active">Accueil</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item me-2"><a href="/admin" class="nav-link active">Administration</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                                @if (Auth::user()->file_path)
                                    <img src="{{ asset('images/profile/' . Auth::user()->file_path) }}" class="navbar-img">
                                @else 
                                    <img src="{{ asset('images/profile/default-profile-pic.jpg') }} " class="rounded-circle navbar-img">
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class=" nav-item"><a class="dropdown-item nav-link" href="/account">Mon compte</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                
                                    <li class="nav-item"> 
                                        <a href="route('logout')" class="nav-link dropdown-item"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Déconnexion') }}
                                        </a>
                                    </li>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2"><a href="{{ route('login') }}" class="nav-link active">Connexion</a></li>

                        @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link active">Inscription</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
                <!-- Authentication -->
        </header>
    </div>
​
    <div class="container" id="news" style="margin-bottom:150px">
        @yield('content')
    </div>
​
    <div class="container">
        <p>© 2022 Créative - Tous droits réservés</p>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>  
</body>
</html>

<style>
    .navbar-img {
        width: 35px;
        height: 35px;
        margin-left: 7px;
        margin-right: 2px; 
    }

    .dropdown-toggle::after {
        margin-left: 0;
    }
</style>