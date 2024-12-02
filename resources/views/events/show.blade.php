@extends('layouts.app')
@section('title', 'AdvFut - Evento')
@section('content')
    <div class="w-full flex flex-col">
        <div class="bg-cover bg-bottom w-full h-[500px] flex items-start justify-center"
            style="background-image:url('/img/torcedores.jpg')">
            <x-header />
        </div>

        <div class="w-full flex items-center justify-center">
            <div class="w-full max-w-7xl py-5 flex flex-col sm:flex-row gap-3">
                <div id="image-container" class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="/img/events/{{ $equipe->imagem }}" class="img-fluid" alt="{{ $equipe->clube }}">
                </div>

                <div id="info-container" class="col-md-4">
                    <p class="event-club"><ion-icon name="body-outline"></ion-icon> {{ $eventOwner->name }} </p>
                    <a href="/teams/{{ $equipe->id }}"><ion-icon name="shield-outline"></ion-icon>{{ $equipe->clube }}</a>
                    <p class="event-date"><ion-icon name="calendar-number-outline"></ion-icon>
                        {{ date('d/m/y', strtotime($agenda->data)) }}</p>
                    <p class="event-horario"><ion-icon name="alarm-outline"></ion-icon>
                        {{ \Carbon\Carbon::parse($agenda->hora)->format('H:i') }} </p>
                    <p class="event-dure"><ion-icon name="stopwatch-outline"></ion-icon>
                        {{ \Carbon\Carbon::parse($agenda->duracao)->format('H:i') }} </p>
                    <p class="event-quadras"><ion-icon name="football-outline"></ion-icon> {{ $agenda->tipo }} </p>
                    <p class="event-local"><ion-icon name="home-outline"></ion-icon> {{ $agenda->endereco }} </p>
                    <p class="event-bairro"><ion-icon name="trail-sign-outline"></ion-icon> {{ $agenda->bairro }} </p>
                    <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $agenda->cidade }} </p>
                    <p class="event-pagamento"><ion-icon name="cash-outline"></ion-icon> {{ $agenda->pagamento }} </p>
                    @if (auth()->check())
                        @if ($agenda->equipe_adversario == null)
                            <form action="/events/join/{{ $agenda->id }}" method="POST">
                                @csrf
                                <div>
                                    <label for="equipe_id">Escolhe seu time:</label>
                                    <select name="equipe_id" id="equipe_id" class="form-control" required>
                                        @foreach ($user->equipes as $equipe)
                                            <option value="{{ $equipe->id }}">{{ $equipe->clube }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" id="event-submit">Confirmar partida</button>
                            </form>
                        @else
                            <p class="already-joined-msg">Esse time já está participando deste jogo contra o adversário:
                                {{ $agenda->equipeAdversario->clube }}</p>
                        @endif
                    @else
                        <p class="login-msg">Para confirmar a participação, -> <a href="/login">faça login</a> <- na sua
                                conta.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full flex items-center justify-center">
            <div class="w-full max-w-7xl py-5 flex flex-col gap-3" id="description-container">
                <h3>Descrição sobre o adversário:</h3>
                <p class="event-description">{{ $agenda->observacao }}</p>
            </div>
        </div>

        <div class="w-full flex items-center justify-center">
            <div class="w-full max-w-7xl py-5 flex flex-row gap-3">
                <div id="mapa" class="w-full h-[400px]">
                    <h3>Localização</h3>
                    <div style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                </div>
            </div>
        </div>

        <x-footer />
    </div>

    <script>
        function initMap() {
            // Cria o geocoder para converter o endereço em coordenadas
            const geocoder = new google.maps.Geocoder();
            const address = "{{ $agenda->endereco }}, {{ $agenda->bairro }}, {{ $agenda->cidade }}"; // Endereço completo
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    const location = results[0].geometry.location;
                    // Configurações do mapa
                    const map = new google.maps.Map(document.getElementById("mapa"), {
                        zoom: 15,
                        center: location,
                    });
                    // Adiciona um marcador no mapa
                    const marker = new google.maps.Marker({
                        position: location,
                        map: map,
                    });
                } else {
                    alert("Geocodificação falhou: " + status);
                }
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyBGXD26QCwEwOi2kaiDjFcnZ6dXxTivs&callback=initMap"></script>
@endsection
