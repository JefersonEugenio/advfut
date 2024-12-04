@extends('layouts.main')

@section('title', 'Criar time')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Cria um time</h1>
    <form action="/eventscreateteam" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do escudo do time:</label>
            <input type="file" id="imagem" name="imagem" class="from-control-file" required>
        </div>
        <div class="form-group">
            <label for="title">Nome do time:</label>
            <input type="text" class="form-control" id="clube" name="clube" placeholder="Ex: F. C. IFRS" required>
        </div>
        <input type="submit" value="Criar time" class="bg-orange-400 w-full sm:w-auto px-8 h-12 text-white rounded-md hover:bg-blue-900">
    </form>
</div>

@endsection