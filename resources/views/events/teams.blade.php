@extends('layouts.main')

@section('title', 'teams')

@section('content')

<div class="container">
    
    <div class="row">

        <div id="teamsImage" class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="/img/events/{{ $equipe->imagem }}" class="img-fluid" style="max-width: 200px; height: auto;" alt="{{ $equipe->clube }}">
        </div>
        <div id="info-container" class="col-md-6">
            <p class="event-club"><ion-icon name="body-outline"></ion-icon> {{ $user->name }} </p>
            <p class="event-club"><ion-icon name="shield-outline"></ion-icon> {{ $equipe->clube }} </p>
        </div>

        <div class="row mt-4">
            <div class="col-md-12" id="comentario">
                <hr>
                <h3>Os adversários comentários e dar notas sobre time: </h3>
                <hr>
                <div class="comentarios-e-notas">
                        @if ($comentarios->isNotEmpty() && $notas->isNotEmpty())
                            @foreach ($comentariosNotas as $item)
                                <div class="comentario-nota">
                                    <p class="event-comentario-nota"> 
                                        Comentário: {{ $item[0]->avaliacao_comentario }} | 
                                        Nota: {{ $item[1]->avaliacao_nota ?? 'Sem nota' }}
                                    </p>
                                    <p class="event-equipe">Equipe: {{ $item[0]->equipe_avaliacao }}</p>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <p class="event-comentario">Sem comentários ou notas disponíveis.</p>
                        @endif
                </div>
            </div>
        </div>

    </div>

</div>

@endsection