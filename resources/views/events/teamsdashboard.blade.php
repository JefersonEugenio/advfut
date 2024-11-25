@extends('layouts.main')

@section('title', 'Times')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($equipes) > 0)
        <div class="col-md-10 offset-md-1 dashboard-title-container">
            <h1>Meus times</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome do meu time</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            @foreach($equipes as $equipe)
                @if(auth()->id() == $equipe->user_id)
                    <tbody>                    
                        <tr>
                            <td>
                                <a href="/teams/{{ $equipe->id }}">{{ $equipe->id }} - {{ $equipe->clube }}</a><br>
                            </td>
                            <td>
                                <a href="/events/teamsedit/{{ $equipe->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>
                                <form action="/teamsevents/{{ $equipe->id }}" method="POST">
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
        <p>Você ainda não tem time, <a href="/events/createteams">criar um time</a></p>
    @endif
</div>

@endsection