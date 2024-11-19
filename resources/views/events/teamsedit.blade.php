@extends('layouts.main')

@section('title', 'Criar time')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editar seu time</h1>
    <form action="/events/teamsupdate/{{ $equipes->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <img src="/img/events/{{ $equipes->imagem }}" alt="{{ $equipes->imagem }}" class="img-preview">
            <label for="image">Imagem do escudo do time:</label>
            <input type="file" id="imagem" name="imagem" class="from-control-file">
        </div>
        <div class="form-group">
            <label for="title">Nome do time:</label>
            <input type="text" class="form-control" id="clube" name="clube" value="{{ $equipes->clube }}">
        </div>
        <input type="submit" value="Editar time" class="btn btn-primary">
        <a href="/teamsdashboard" value="Cancela" class="btn btn-danger">Cancela</a>
    </form>
</div>

@endsection