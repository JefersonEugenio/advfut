<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Agenda;
use App\Models\User;
use App\Notifications\AgendaDeletedNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EventController extends Controller {

    public function index() {
        return view('index');
    }

    public function eventos() {
        
        $search = request('search');
        $agendas = Agenda::all();

        if($search) {
            $equipes = Equipe::where([
                ['clube', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $equipes = Equipe::all();
        }


        return view('welcome', ['equipes' => $equipes, 'search' => $search, 'agendas' => $agendas]);

    }

    public function create() {
        $equipes = Equipe::where('user_id', auth()->id())->get();
        return view('events.create', compact('equipes'));
    }

    public function createteams() {
        return view('events.createteams');
    }

    public function teste() {
        return view('teste');
    }
    
    public function store(Request $request) {
        $agendas = new Agenda();

        $agendas->user_id = $request->user_id;
        $agendas->equipe_me = $request->equipe_id;
        $agendas->data = $request->data;
        $agendas->hora = $request->hora;
        $agendas->duracao = $request->duracao;
        $agendas->tipo = $request->tipo;
        $agendas->endereco = $request->endereco;
        $agendas->bairro = $request->bairro;
        $agendas->cidade = $request->cidade;
        $agendas->pagamento = $request->pagamento;
        $agendas->observacao = $request->observacao;
        
        $agendas->save();

        return redirect('/adversary')->with('msg', 'Sua partida foi criado com sucesso!');

    }

    public function createteam(Request $request) {
        $time = new Equipe();

        $time->clube = $request->clube;

        // Image Upload
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            
            $requestImage = $request->imagem;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $time->imagem = $imageName;

        }

        // video #23
        $user = auth()->user();
        $time->user_id = $user->id;
        
        $time->save();

        // $time->equipe()->create(['name' => $request->name]);

        return redirect('/')->with('msg', 'Seu time foi criado com sucesso!');

    }

    public function show($id) {
        // Verifique se o usuário autenticado já está participando deste evento
        $user = auth()->user();
        $agenda = Agenda::findOrFail($id);

        $agenda = Agenda::with(['equipeMe', 'equipeAdversario'])->findOrFail($id);

        // Busque a agenda específica pelo ID
        $agendas = Agenda::findOrFail($id);
    
        // Busque a equipe que corresponde ao campo `equipe_me` na agenda
        $equipe = Equipe::findOrFail($agendas->equipe_me);
    
        // Encontre o dono do evento
        $eventOwner = User::where('id', $equipe->user_id)->first();
    
    
        return view('events.show', [
            'user' => $user,
            'equipe' => $equipe,
            'agenda' => $agenda,
            'equipeMe' => $agenda->equipeMe,
            'equipeAdversario' => $agenda->equipeAdversario,
            'agendas' => $agendas,
            'eventOwner' => $eventOwner
        ]);

    }

    public function dashboard() {

        $user = auth()->user();

        $equipes = $user->equipes;

        $agendasAsParticipant = $user->agendasAsParticipant()->with('equipeAdversario')->get();

        // Obter todas as agendas criadas pelo usuário, incluindo a equipe adversária
        $agendas = Agenda::where('user_id', $user->id)->with('equipeAdversario')->get();

        $agendas = Agenda::all();

        ($equipes);

        return view('events.dashboard', [
            'user' => $user,
            'equipes' => $equipes, 
            'agendasAsParticipant' => $agendasAsParticipant,
            'agendas' => $agendas
            
            
        ]);
    }

    public function teams() {

        $user = auth()->user();

        $equipes = $user->equipes;

        return view('events.teamsdashboard', [
            'user' => $user,
            'equipes' => $equipes
        ]);
    }

    public function destroy($id) {

        Agenda::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Sua partida foi excluída com sucesso!');
    }

    public function teamsdestroy($id) {

        Equipe::findOrFail($id)->delete();

        return redirect('/teamsdashboard')->with('msg', 'Seu time foi excluída com sucesso!');
    }

    public function edit($id) {

        $user = auth()->user();

        $agenda = Agenda::findOrFail($id);

        if($user->id != $agenda->user_id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['agenda' => $agenda]);
    }

    public function teamsedit($id) {

        $user = auth()->user();

        $equipes = Equipe::findOrFail($id);

        if($user->id != $equipes->user_id) {
            return redirect('/dashboard');
        }

        return view('events.teamsedit', ['equipes' => $equipes]);
    }

    public function update(Request $request) {

        $data = $request->all();

        Agenda::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Editado com sucesso!');
    }

    public function teamsupdate(Request $request) {

        $data = $request->all();

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            
            $requestImage = $request->imagem;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['imagem'] = $imageName;
        }

        Equipe::findOrFail($request->id)->update($data);

        return redirect('/teamsdashboard')->with('msg', 'Editado com sucesso!');
    }

    public function joinEvent(Request $request, $id) {

        $user = auth()->user();
        $agendas = Agenda::findOrFail($id);

        if ($agendas->user_id == $user->id) {
            return redirect('/adversary')->with('msg', 'Você não pode confirmar participação com o mesmo dono que criou a partida.');
        }
        
        // Define o time adversário com base no valor selecionado no formulário
        $agendas->equipe_adversario = $request->equipe_id;
        $agendas->save();

        if ($user->equipes->isEmpty()) {
            return redirect('/dashboard')->with('msg', 'Você precisa criar um time antes de confirmar participação.');
        }


        $user->agendasAsParticipant()->attach($id);

        return redirect('/dashboard')->with('msg', 'Seu time está confirmado para o jogo contra o adversário: ' . $agendas->equipeMe->clube);
    }

    public function leaveEvent($id) {
        
        $equipe = Equipe::findOrFail($id);

        $agendas = Agenda::where('equipe_adversario', $equipe->id)->get();

        foreach ($agendas as $agenda ) {
                $agenda->equipe_adversario = null;
                $agenda->save();
        }

        return redirect('/dashboard')->with('msg', 'Seu time saiu com sucesso do jogo contra o adversário: ' . $agenda->equipeMe->clube );
    }

    public function deleteAgenda($agendaId) {
        // Encontre a agenda
        $agenda = Agenda::findOrFail($agendaId);
    
        // Encontre o adversário (se houver)
        $adversario = $agenda->equipeAdversario;
    
        if ($adversario) {
            $userAdversario = $adversario->user;
            if ($userAdversario) {
                Log::info('Preparando para enviar notificação ao usuário: ' . $userAdversario->id);
    
                // Enviar notificação ao adversário
                $userAdversario->notify(new AgendaDeletedNotification($agenda));
    
                Log::info('Notificação enviada com sucesso ao usuário: ' . $userAdversario->id);
            } else {
                Log::warning('Usuário do adversário não encontrado.');
            }
        } else {
            Log::warning('Adversário não encontrado para a agenda.');
        }
    
        // Apagar a agenda
        $agenda->delete();
    
        return redirect()->back()->with('message', 'Agenda deletada com sucesso!');
    }

    public function notifications() {
        $user = auth()->user(); // Usuário autenticado
        $notifications = $user->notifications()->latest()->get(); 

        return view('notifications.index', ['notifications' => $notifications]);
    }
}