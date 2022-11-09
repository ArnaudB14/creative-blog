<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
    <title>Blog Créative</title>
</head>
<body>
​
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center align-items-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">Blog Créative</span>
            </a>
            <ul class="nav align-items-baseline">
                <li class="nav-item me-2"><a href="/" class="nav-link active">Accueil</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item me-2"><a href="/admin" class="nav-link active">Administration</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                                @if (Auth::user()->file_path)
                                    <img src="{{ asset('images/profile/' . Auth::user()->file_path) }}" class="navbar-img rounded-circle">
                                @else 
                                    <img src="{{ asset('images/profile/default-profile-pic.jpg') }} " class="rounded-circle navbar-img">
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class=" nav-item"><a class="dropdown-item nav-link" href="/account">Mon compte</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
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

            <i class="bi bi-brightness-high mx-2"></i>
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input me-2" type="checkbox" id="flexSwitchCheckDefault" role="button" checked="checked">
                <label class="form-check-label" for="flexSwitchCheckDefault" id="theme-toggle"><i class="bi bi-moon-fill"></i></label>
            </div>
            
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
  
</style>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript">

    var body = document.getElementsByTagName('body')[0];
    var dark_theme_class = 'dark-theme';
    var theme = getCookie('theme');

    if(theme != '') {
        body.classList.add(theme);
    };

    if (body.classList.contains(dark_theme_class)) {
        $('#flexSwitchCheckDefault').prop('checked',true);
    }

    else {
        $('#flexSwitchCheckDefault').prop('checked',false);
    }

    document.addEventListener('DOMContentLoaded', function () {


        $('#flexSwitchCheckDefault').on('click', function () {

            if (body.classList.contains(dark_theme_class)) {

                body.classList.remove(dark_theme_class);
                $('#mode').text('Light Mode')
                setCookie('theme', 'light');

            }
            else {

                $('#mode').text('Dark Mode')

                body.classList.add(dark_theme_class);

                setCookie('theme', 'dark-theme');

            }
        });
    });

    // enregistrement du theme dans le cookie

    function setCookie(name, value) {

        var d = new Date();
        d.setTime(d.getTime() + (365*24*60*60*1000));
        var expires = "expires=" + d.toUTCString();
        console.log(expires)
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
        console.log(document.cookie)
    }

    // methode de recuperation du theme dans le cookie

    function getCookie(cname) {

        var theme = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');

        for(var i = 0; i < ca.length; i++) {

            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(theme) == 0) {
                return c.substring(theme.length, c.length);
            }
        }
        return "";
    }

</script>