<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class UserConsultation extends Notification
{
    use Queueable;

    public $user;
    public $consulta;
    public $tenant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $consulta, $tenant)
    {
        $this->user = $user;
        $this->consulta = $consulta;
        $this->tenant = $tenant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'user_id' => $this->user['id'],
            'tenant_id' => $this->tenant,
            'consulta_id' => $this->consulta['id'],
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'msg' => "La consulta no ha sido terminada"
        ];
    }
}
