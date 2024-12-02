<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- CSS da aplicação -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="/img/ADVFUTlogo.png" alt="logo" style="width: 60px; height: auto;">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a href="/adversary" class="nav-link">Partida</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/createteams" class="nav-link">Criar time</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar partida</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/teamsdashboard" class="nav-link">Meu time</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Minha partida</a>
                        </li>
                        <li class="nav-item">
                        <a href="/notifications" class="nav-link">
                            <?php $noti = auth()->user()->unreadNotifications->count(); ?>
                                Notificação
                                @php
                                    $noti = auth()->user()->unreadNotifications->count();
                                @endphp
                                @if($noti > 0)
                                    <span class="badge badge-danger" style="color: white; background-color: red;">{{ $noti }}</span>
                                @endif
                        </a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" 
                                onclick="event.preventDefault();this.closest('form').submit();">Sair</a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                        <p class="msg">{{ session('msg') }}</p>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p>AdvFut &copy; 2024</p>
        </footer>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    </body>
</html>
