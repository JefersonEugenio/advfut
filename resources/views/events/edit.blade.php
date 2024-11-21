@extends('layouts.main')

@section('title', 'Editando: ' . $agenda->equipeMe->clube)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $agenda->equipeMe->clube }}</h1>
    <form action="/events/update/{{ $agenda->id }}" method="POST" enctype="multipart/form-data" id="eventForm">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="date">Data do partida:</label>
            <input type="date" class="form-control" id="data" name="data" value="{{ \carbon\carbon::parse($agenda->data)->format('Y-m-d') }}" required>
        </div>
        <div>
            <label for="time">Horario do partida:</label>
            <input type="time" class="form-control" id="hora" name="hora" value="{{ $agenda->hora }}" required>
        </div>
        <div>
            <label for="time">Durante do jogo:</label>
            <input type="time" class="form-control" id="duracao" name="duracao" value="{{ $agenda->duracao }}" required>
        </div>
        <div class="form-group">
            <label for="title">Tipos de quadras esportivas?</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="futsal" {{ $agenda->tipo == "futsal" ? "selected='selected'" : "" }}>Futsal</option>
                <option value="society">Society</option>
                <option value="campo">Campo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Endereço do ginásio:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex: Rua Maria Zélia, 870" value="{{ $agenda->endereco }}" required>
        </div>
        <div class="form-group">
            <label for="title">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Igara III" value="{{ $agenda->bairro }}" required>
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Ex: Canoas" value="{{ $agenda->cidade }}" required>
        </div>
        <div class="form-group">
            <label for="title">A forma de pagamento?</label>
            <select name="pagamento" id="pagamento" class="form-control">
                <option value="0">Metade por time</option>
                <option value="1" {{ $agenda->pagamento == 1 ? "selected='selected'" : "" }}>Grátis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Observação:</label>
            <textarea name="observacao" id="observacao" class="form-control" placeholder="O time iniciante">{{ $agenda->observacao }}</textarea>
        </div>
        
        <input type="submit" value="Editar partida" class="btn btn-primary">
        <a href="/dashboard" value="Cancela" class="btn btn-danger">Cancela</a>
    </form>
</div>

<script>
    // Obtém a data e hora atuais
    const now = new Date();
    const today = now.toISOString().split('T')[0];
    const currentHours = String(now.getHours()).padStart(2, '0');
    const currentMinutes = String(now.getMinutes()).padStart(2, '0');
    const currentTime = `${currentHours}:${currentMinutes}`;

    // Define o mínimo no campo de data
    const dateInput = document.getElementById('data');
    const timeInput = document.getElementById('hora');
    dateInput.setAttribute('min', today);

    // Valida na submissão
    document.getElementById('eventForm').addEventListener('submit', (event) => {
        const selectedDate = dateInput.value;
        const selectedTime = timeInput.value;

        if (selectedDate === today && selectedTime < currentTime) {
            alert('Por favor, escolha um horário válido para hoje!');
            event.preventDefault(); // Impede o envio do formulário
        }
    });

    // Define o horário mínimo ao selecionar a data
    dateInput.addEventListener('change', () => {
        if (dateInput.value === today) {
            timeInput.setAttribute('min', currentTime);
        } else {
            timeInput.removeAttribute('min'); // Remove restrição para datas futuras
        }
    });
</script>

@endsection