<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AgendaDeletedNotification extends Notification
{
    use Queueable;

    protected $agenda;

    /**
     * Create a new notification instance.
     */
    public function __construct($agenda)
    {
        $this->agenda = $agenda;
        Log::info('Notificação construída para a agenda: ' . $agenda->id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable) {
        return [
            'message' => 'A agenda para o jogo ' . $this->agenda->equipeMe->clube . ' x ' . $this->agenda->equipeAdversario->clube . ' foi excluída ou cancelada.',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Agenda Cancelada')
                    ->line('A agenda para o jogo ' . $this->agenda->equipeMe->clube . ' X ' . $this->agenda->equipeAdversario->clube . ' foi cancelada.' )
                    ->action('Ver Agenda', url('/dashboard'))
                    ->line('Se tiver dúvidas, entre em contato!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "A agenda de um adversário foi apagada. toArray",
            'agenda_id' => $this->agenda->id,
            'equipe_nome' => $this->equipe->clube,
            'agenda_date' => $this->agenda->data,
        ];
    }
}
