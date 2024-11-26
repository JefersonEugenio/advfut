@extends('layouts.main')

@section('title', 'teams')

@section('content')

<div class="container">
    
    <div class="row">

        <div id="teamsImage" class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="/img/events/{{ $equipe->imagem }}" class="img-fluid" style="max-width: 200px; height: auto;" alt="{{ $equipe->clube }}">
        </div>

        <div id="info-container" class="col-md-6">
            <p class="event-club"><ion-icon name="body-outline"></ion-icon> {{ $eventOwner->name }} </p>
            <p class="event-club"><ion-icon name="shield-outline"></ion-icon> {{ $equipe->clube }} </p>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12" id="comentario">
            <h3>Comentario e notas sobre o adversário:</h3>
            <p class="event-comentario">COMENTARIO - ( {{ $equipe->avaliacao_comentarios }} ) | NOTAS ( {{$equipe->avaliacao_nota}} )</p>
        </div>
    </div>
</div>

@endsection