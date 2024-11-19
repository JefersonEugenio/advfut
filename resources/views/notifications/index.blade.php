@extends('layouts.main')

@section('title', 'Notificações')

@section('content')

<div class="col-md-10 offset-md-1">
    <h1>Notificações</h1>

    @if($notifications->count() > 0)
        <ul>
            @foreach($notifications as $notification)
                <li>
                    {{ $notification->data['message'] ?? 'Sem mensagem' }}
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p>Sem notificações no momento.</p>
    @endif
</div>

@endsection