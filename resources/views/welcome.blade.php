@extends('layouts.app')
@section('title', 'AdvFut - Adversários')
@section('content')
    <div class="w-full flex flex-col">
        <div class="bg-cover bg-bottom w-full h-[500px] flex items-start justify-center"
            style="background-image:url('/img/torcedores.jpg')">
            <x-header />
        </div>
        <div id="search-container" class="w-full flex items-center justify-center">
            <div class="w-full max-w-7xl py-5 flex flex-col items-center gap-3">
                <h1>Busque um adversário</h1>
                <form action="/adversary" method="GET">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Procurando...">
                </form>
            </div>
        </div>
        <div id="events-container" class="w-full flex items-center justify-center">
            <div class="w-full max-w-7xl py-5 flex flex-col gap-3">
                @if ($search)
                    <h2>Buscando por: {{ $search }}</h2>
                @else
                    <h2>Próximos adversários</h2>
                    <p class="subtitle">Confira os adversários dos próximos dias</p>
                @endif
                <div id="cards-container" class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($agendas as $agenda)
                        @if ($agenda->id && $agenda->status == 1)
                            @foreach ($equipes as $equipe)
                                @if ($agenda->equipe_me == $equipe->id)
                                    <div class="w-full flex flex-row gap-2">
                                        @if (!empty($equipe->imagem) && file_exists(public_path("img/events/{$equipe->imagem}")))
                                            <?php $escudo = "/img/events/" . $equipe->imagem ?>
                                        @else
                                            <?php $escudo = "/img/emblema.png" ?>
                                        @endif
                                        <div class="bg-cover bg-center w-32 h-32" style="background-image:url(<?= $escudo; ?>)"></div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $equipe->clube }}</h5>
                                            <div class="card-date">Quadra: {{ $agenda->tipo }}</div>
                                            <div class="card-date">Disponivel para {{ date('d/m/y', strtotime($agenda->data)) }}</div>
                                            <div>Horario: {{ \Carbon\Carbon::parse($agenda->hora)->format('H:i') }}</div>
                                            <a href="/events/{{ $agenda->id }}" class="btn btn-primary">Saber mais</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if (count($equipes) == 0 && $search)
                        <p>Não foi possível encontrar nenhum adversário com {{ $search }}! <a href="/adversary"> Ver todos</a></p>
                    @elseif(count($equipes) == 0)
                        <p>Não há adversários disponíveis</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
