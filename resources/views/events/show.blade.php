@extends('layouts.app')
@section('title', 'AdvFut - Evento')
@section('content')
    <div class="w-full flex flex-col">
        <div class="bg-cover bg-bottom w-full h-[500px] flex items-start justify-center"
            style="background-image:url('/img/torcedores.jpg')">
            <x-header />
        </div>

        <div class="m-5 flex flex-col sm:flex-row items-start justify-between gap-3">
            <div class="w-full flex flex-col">
                <div class="w-full flex items-center justify-center">
                    <div class="w-full max-w-7xl p-3 border border-gray-400 rounded-md flex flex-col gap-3">
                        <div class="w-full flex flex-col sm:flex-row gap-4">
                            <div id="image-container" class="bg-cover bg-center w-full sm:w-60 h-60"
                                style="background-image:url(<?= '/img/events/' . $equipe->imagem ?>)"></div>
                            <div id="info-container" class="col-md-4">
                                <a href="/teams/{{ $equipe->id }}" class="text-xl">{{ $equipe->clube }}</a>
                                <p class="text-gray-500">Proprietário: {{ $eventOwner->name }}</p>
                                <p class="event-date">Data: {{ date('d/m/y', strtotime($agenda->data)) }}</p>
                                <p class="event-horario">Hora: {{ \Carbon\Carbon::parse($agenda->hora)->format('H:i') }}</p>
                                <p class="event-dure">Duração: {{ \Carbon\Carbon::parse($agenda->duracao)->format('H:i') }}
                                </p>
                                <p class="event-quadras">Tipo de jogo: {{ $agenda->tipo }}</p>
                                <div class="event-local">
                                    <p>Endereço:</p>
                                    <p class="underline">{{ $agenda->endereco }}, {{ $agenda->bairro }} - {{ $agenda->cidade }}</p>
                                </div>
                                <p class="event-pagamento">Pagamento: {{ $agenda->pagamento }}</p>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1">
                            <h3>Descrição sobre o adversário:</h3>
                            <p class="event-description">{{ $agenda->observacao ? $agenda->observacao : "Sem descrição" }}</p>
                        </div>

                        @if (auth()->check())
                            @if ($agenda->equipe_adversario == null)
                                <form action="/events/join/{{ $agenda->id }}" method="POST" class="flex flex-col sm:flex-row items-end justify-end gap-3">
                                    @csrf
                                    <select name="equipe_id" id="equipe_id" class="w-full sm:w-auto h-12 rounded-md" required>
                                        @foreach ($user->equipes as $equipe)
                                            <option disabled>Selecione uma equipe</option>
                                            <option value="{{ $equipe->id }}">{{ $equipe->clube }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-orange-400 w-full sm:w-auto px-8 h-12 text-white rounded-md hover:bg-blue-700" id="event-submit">Confirmar partida</button>
                                </form>
                            @else
                                <p class="already-joined-msg">Esse time já está participando deste jogo contra o
                                    adversário:
                                    {{ $agenda->equipeAdversario->clube }}</p>
                            @endif
                        @else
                            <p class="login-msg">Para confirmar a participação, -> <a href="/login"><b><font color="blue">faça login</font></b></a> <- na sua conta.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-full sm:max-w-lg flex items-center justify-center">
                <div class="w-full max-w-7xl flex flex-row gap-3">
                    <div id="mapa" class="w-full h-[400px]">
                        <h3>Localização</h3>
                        <div style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                    </div>
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
