@extends('layouts.app')
@section('title', 'AdvFut - Principal')
@section('content')
    <div class="w-full flex flex-col">
        <div class="bg-cover bg-bottom w-full h-[500px] flex items-start justify-center" style="background-image:url('/img/torcedores.jpg')">
            <x-header />
        </div>
        <div class="w-full flex justify-center">
            <div class="w-full max-w-7xl py-8 px-3 flex flex-col justify-center gap-5">
                <h2 class="w-full text-center text-4xl font-bold">Quem somos AdvFut</h2>
                <p class="text-center">O nome "AdvFut" do nosso aplicativo. "Adv" representa "adversário", enquanto "Fut" abrange todas as modalidades de futebol, incluindo futebol de campo, futsal e society. Nosso foco é nos esportes de bola jogados em equipe, facilitando o encontro de adversários e a organização de partidas de maneira rápida e prática.</p>
                <p class="text-center">A AdvFut é uma solução inovadora para facilitar a organização de partidas de futebol entre equipes. Com nosso aplicativo, buscamos simplificar o processo de busca e marcação de jogos com adversários, evitando o trabalho e a perda de tempo com redes sociais e outros métodos informais. Nosso objetivo é otimizar o tempo e aumentar a eficiência das equipes, proporcionando um ambiente prático para agendar e gerenciar partidas, além de melhorar a experiência de organização de jogos para todos. A AdvFut é para quem quer focar no que importa: jogar bola com praticidade e organização.</p>
                <h2 class="w-full text-center text-4xl font-bold">Como funciona no sistema</h2>
                <p class="text-center">Para marcar uma partida no AdvFut, comece clicando em 'Criar time' e preenchendo as informações do seu time, incluindo o nome e a foto do escudo. Após criar o time, você pode agendar uma partida, tornando o jogo disponível. Preencha os dados necessários, como endereço do local, bairro, cidade, data e horário da partida, duração do jogo, tipo de quadra e forma de pagamento. Depois do cadastro, a partida será publicada no sistema, e o seu time ficará disponível para receber convites de adversários interessados. Os adversários podem confirmar a participação na sua partida, ou você pode aceitar convites de adversários para partidas que combinem com a sua disponibilidade. Com isso, a partida será marcada, eliminando a necessidade de contato por redes sociais e garantindo uma organização prática e eficiente.</p>
                <h2 class="w-full text-center text-4xl font-bold">Avaliação adversário</h2>
                <p class="text-center">Você precisa avaliar o seu adversário em diversos critérios e vice-versa (pontualidade, fair play, uniforme e muito mais). Como cada time é avaliado pelo seu adversário, o seu time acaba criando a própria reputação, que pode ser consultada por todos. Assim, você pode avaliar os times antes aceitar convites.</p>
            </div>
        </div>
        <x-footer />
    </div>
@endsection
