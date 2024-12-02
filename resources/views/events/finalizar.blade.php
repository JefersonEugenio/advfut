@extends('layouts.main')

@section('title', 'finalizar')

@section('content')

<style>
    .resultado-jogo {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-control {
        width: 60px;
        text-align: center;
    }
    .form-control-text {
        width: 250px;
       
    }
</style>

<form action="/events/{{$agenda->id}}/finalizar" method="POST">
    @csrf
    @method('POST')
    
    <div class="form-group">
        <div class="resultado-jogo">
            {{ $agenda->equipeMe->clube }}
            <input type="number" name="timeA" class="form-control" id="timeA" max="99" required>
            <span>X</span>
            <input type="number" name="timeB" class="form-control" id="timeB" min="0" max="99" required>
            {{ $agenda->equipeAdversario->clube }}
        </div>
    </div>
    
    <div class="form-group">
        <label for="notas_adversario">Notas para o time adversário:</label>
        <select id="notas_adversario" name="notas_adversario" required>
            <option value="" disabled selected>Selecione uma nota</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="comentarios">Comentários sobre adversario:</label><br>
        <textarea name="comentarios" class="form-control-text" id="comentarios" placeholder="Exemplo: O jogo foi intenso!"></textarea>
    </div>

    <input type="hidden" name="equipeAvaliacao" value="{{$agenda->equipeMe->clube}}">
    <input type="hidden" name="status" value="0">
    <button type="submit" class="btn btn-success">Salvar resultado</button>
</form>

@endsection