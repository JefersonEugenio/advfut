<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgendaEditNotification extends Notification
{
    use Queueable;

    protected $agenda;

    public function __construct($agenda)
    {
        $this->agenda = $agenda;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'O time ' . ($this->agenda->equipeAdversario->clube ?? 'Desconhecido') . ' editou a agenda da partida no jogo contra o seu time ' . $this->agenda->equipeMe->clube . '.'
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
