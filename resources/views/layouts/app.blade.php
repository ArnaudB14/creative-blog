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
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">Blog Créative</span>
            </a>
​
            <ul class="nav">
                <li class="nav-item me-2"><a href="/" class="nav-link active">Accueil</a></li>
                @if (Route::has('login'))
                    @auth
                        {{-- <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link active">Dashboard</a></li> 
                        <li class="nav-item me-2"><a href="{{ url('/hello-creative') }}" class="nav-link active">Hello</a></li>--}}
                        <li class="nav-item me-2"><a href="/admin" class="nav-link active">Administration</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
        
                            <li class="nav-item"> 
                                <a href="route('logout')" class="nav-link active"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                                </a>
                            </li>
                        </form>
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
    
</body>
</html>