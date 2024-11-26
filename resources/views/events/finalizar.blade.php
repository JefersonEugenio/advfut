@extends('layouts.main')

@section('title', 'finalizar')

@section('content')

<form action="/events/{{$agenda->id}}/finalizar" method="POST">
    @csrf
    @method('PATCH')
    
    <div class="form-group">
        <label for="resultado">Resultado do jogo:</label>
        <input type="text" name="resultado" class="form-control" id="resultado" placeholder="Exemplo: 2x1">
    </div>
    
    <div class="form-group">
        <label for="notas_adversario">Notas para o time adversário:</label>
        <select id="notas_adversario" name="notas_adversario">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="comentarios">Comentários sobre adversario:</label>
        <textarea name="comentarios" class="form-control" id="comentarios" placeholder="Exemplo: O jogo foi intenso!"></textarea>
    </div>
    <input type="hidden" name="status" value="0">
    <button type="submit" class="btn btn-success">Salvar resultado</button>
</form>

@endsection