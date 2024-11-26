@extends('layouts.main')

@section('title', 'Adversários')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um adversário</h1>
    <form action="/adversary" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurando...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{ $search }}</h2>
    @else
        <h2>Próximos adversários</h2>
        <p class="subtitle">Confira os adversários dos próximos dias</p>
    @endif
    <p>usuario: {{ auth()->id() }}</p>
    
    <div id="cards-container" class="row">
    @foreach($agendas as $agenda)
        @if($agenda->id && $agenda->status == 1)
            @foreach($equipes as $equipe)
                @if($agenda->equipe_me == $equipe->id)
                    <div class="card col-md-3">
                        @if(!empty($equipe->imagem) && file_exists(public_path("img/events/{$equipe->imagem}")))
                            <img src="/img/events/{{ $equipe->imagem }}" alt="{{ $equipe->clube }}">
                        @else
                            <img src="/img/emblema.png" alt="emblema vazio">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $equipe->clube }}</h5>equipe id: {{$equipe->id}}
                            <div class="card-date">Quadra: {{ $agenda->tipo }}</div>
                            <div class="card-date">Disponivel para {{ date('d/m/y', strtotime($agenda->data)) }} e horario: {{ \Carbon\Carbon::parse($agenda->hora)->format('H:i') }}</div>
                            <a href="/events/{{ $agenda->id }}" class="btn btn-primary">Saber mais</a>
                            agenda id: {{ $agenda->id }}
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
    @if(count($equipes) == 0 && $search)
        <p>Não foi possível encontrar nenhum adversário com {{ $search }}! <a href="/adversary"> Ver todos</a></p>
    @elseif(count($equipes) == 0)
        <p>Não há adversários disponíveis</p>
    @endif
    </div>
</div>

@endsection
