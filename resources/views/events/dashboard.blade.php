@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')


<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($equipes) > 0)
        @if(count($agendas) > 0 && auth()->id() == $agendas->where('user_id', auth()->id())->isNotEmpty())
            <div class="col-md-10 offset-md-1 dashboard-title-container">
                <h1>Minha agenda</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome do meu time</th>
                        <th scope="col">Nome do adversário</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                @foreach($agendas as $agenda)
                    @if(auth()->id() == $agenda->user_id)
                        <tbody>                    
                            <tr>
                                <td>
                                    {{ $agenda->equipeMe->clube }}<br>
                                </td>
                                <td>
                                    @if($agenda->equipeAdversario && $agenda->equipeAdversario->clube != null)
                                        {{ $agenda->equipeAdversario->clube }}
                                    @endif
                                </td>
                                <td>
                                    {{ date('d/m/y', strtotime($agenda->data)) }}
                                </td>
                                <td>
                                    <a href="/events/edit/{{ $agenda->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>
                                    <form action="/events/{{ $agenda->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                @endforeach
            </table>
        @else
            <br>
            <p>Você ainda não tem agenda, <a href="/events/create">criar uma agenda</a></p>
        @endif
    @else
        <br>
        <p>Você ainda não tem time, <a href="/events/createteams">criar um time</a></p>
    @endif
</div>
<hr>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    <h1>Agenda em que estou participando contra o adversário</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($agendasAsParticipant) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Meu time</th>
                    <th scope="col">Adversário</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach($agendas as $agenda)
                    @if(auth()->id() == optional($agenda->equipeAdversario)->user_id)
                    Meu id: {{auth()->id()}} - agenda: {{ $agenda->id }} - equipe id: {{ $agenda->equipeAdversario->id }}
                        <tr>
                            <td>{{ $agenda->equipeAdversario->clube }}</td>
                            <td>{{ $agenda->equipeMe->clube }}</td>
                            <td>{{ date('d/m/y', strtotime($agenda->data)) }}</td>
                            <td>
                                <form action="/events/leave/{{ $agenda->equipeAdversario->id }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>Cancelar participação
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não está participando de nenhum jogo contra o adversário, <a href="/adversary"> veja todos os adversários</a></p>
    @endif
</div>

@endsection