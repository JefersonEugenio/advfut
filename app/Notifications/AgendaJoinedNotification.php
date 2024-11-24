<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgendaJoinedNotification extends Notification
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
            'message' => 'O time ' . ($this->agenda->equipeAdversario->clube ?? 'Desconhecido') . ' confirmou participação no jogo contra seu time ' . ($this->agenda->equipeMe->clube ?? 'Desconhecido') . '.'
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Time Confirmado no Jogo')
            ->line('O time ' . $this->agenda->equipeAdversario->clube . ' confirmou participação no jogo contra ' . $this->agenda->equipeMe->clube . '.')
            ->action('Ver Agenda', url('/dashboard'))
            ->line('Confira os detalhes do jogo!');
    }
}