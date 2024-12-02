@extends('layouts.main')

@section('title', 'Criar partida')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Cria um partida</h1>
    <form action="/events" method="POST" enctype="multipart/form-data" id="eventForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div class="form-group">
            <label for="equipe_id">Escolhe seu time:</label>
            <select name="equipe_id" id="equipe_id" class="form-control" required>
            <option value="" disabled selected>Selecione uma equipe</option>
                @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}">{{ $equipe->clube }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Data do partida:</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
        <div>
            <label for="time">Horario do partida:</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <div>
        <label for="duracao">Duração do jogo:</label>
            <select class="form-control" id="duracao" name="duracao" required>
                <option value="" disabled selected>Selecione a duração</option>
                <option value="00:30">00:30</option>
                <option value="00:45">00:45</option>
                <option value="01:00">01:00</option>
                <option value="01:15">01:15</option>
                <option value="01:30">01:30</option>
                <option value="01:45">01:45</option>
                <option value="02:00">02:00</option>
                <option value="02:15">02:15</option>
                <option value="02:30">02:30</option>
                <option value="02:45">02:45</option>
                <option value="03:00">03:00</option>
                <option value="03:15">03:15</option>
                <option value="03:30">03:30</option>
                <option value="03:45">03:45</option>
                <option value="04:00">04:00</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Tipos de quadras esportivas?</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="futsal">Futsal</option>
                <option value="society">Society</option>
                <option value="campo">Campo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Endereço e número do local:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex: Rua Maria Zélia, 870" required>
        </div>
        <div class="form-group">
            <label for="title">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Igara III" required>
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Ex: Canoas" required>
        </div>
       
        <div class="form-group">
            <label for="title">A forma de pagamento?</label>
            <select name="pagamento" id="pagamento" class="form-control">
                <option value="Metade por time">Metade por time</option>
                <option value="Gratis">Grátis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Observação:</label>
            <textarea name="observacao" id="observacao" class="form-control" placeholder="O time iniciante"></textarea>
        </div>
        <input type="hidden" name="status" value="1">
        <input type="submit" value="Criar partida" class="btn btn-primary">
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