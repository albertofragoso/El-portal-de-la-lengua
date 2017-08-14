<?php

namespace App\Notifications;

use App\User;
use App\Conversacion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConversationResponse extends Notification
{
    use Queueable;

    public $user;
    public $conversacion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Conversacion $conversacion)
    {
      $this->user = $user;
      $this->conversacion = $conversacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Respuesta duda del idioma')
                    ->greeting('¡Hola, '. $notifiable->name .'!')
                    ->line($this->user->name . ' ha respondido a tu duda.')
                    ->action('Checa su respuesta', url('/conversaciones/'.$this->conversacion->id))
                    ->salutation('Gracias por usar el Portal de la Lengua.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => $this->user,
            'conversacion' => $this->conversacion,
        ];
    }
}
