<?php

namespace App\Notifications;

use App\User;
use App\Articulo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ArticuloMessage extends Notification
{
    use Queueable;
    public $user;
    public $articulo;
    //public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Articulo $articulo)
    {
        $this->user = $user;
        $this->articulo = $articulo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
                    ->subject('Tienes un nuevo comentario')
                    ->greeting('¡Hola, '. $notifiable->name .'!')
                    ->line('El usuario '. $this->user->name . ' ha comentado tu artículo.')
                    ->action('Checa que opinó ', url('/articulos/'.$this->articulo->id))
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
            'articulo' => $this->articulo,
        ];
    }

    public function toBroadcast($notifiable)
    {
      return new BroadcastMessage([
        'data' => $this->toArray($notifiable)
      ]);
    }
}
