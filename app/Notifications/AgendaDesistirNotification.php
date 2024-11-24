<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgendaDesistirNotification extends Notification
{
    use Queueable;

    protected $agenda;

    public function __construct($agenda)
    {
        $this->agenda = $agenda;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'O time ' . ($this->agenda->equipeAdversario->clube ?? 'Desconhecido') . ' desistiu participação no jogo contra seu time ' . $this->agenda->equipeMe->clube . '.'
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Time Confirmado no Jogo')
            ->line('O time desistiu participação no jogo.')
            ->action('Ver Agenda', url('/dashboard'))
            ->line('Confira os detalhes do jogo!');
    }
}