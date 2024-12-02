<div class="text-white flex flex-col sm:flex-row items-center gap-5">
    <a href="/">Principal</a>
    <a href="/adversary">Eventos</a>
    @auth
        <a href="/events/createteams">Criar time</a>
        <a href="/events/create">Criar partida</a>
        <a href="/teamsdashboard">Meus times</a>
        <a href="/dashboard">Minhas partidas</a>
        <a href="/notifications">
            <?php $noti = auth()->user()->unreadNotifications->count(); ?>
            Notificações
            @php $noti = auth()->user()->unreadNotifications->count(); @endphp
            @if ($noti > 0)
                <span class="badge badge-danger" style="color: white; background-color: red;">{{ $noti }}</span>
            @endif
        </a>
        <form action="/logout" method="POST">
            @csrf
            <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();">Sair</a>
        </form>
    @endauth
    @guest
        <a href="/login">Entrar</a>
        <a href="/register">Registrar</a>
    @endguest
</div>
