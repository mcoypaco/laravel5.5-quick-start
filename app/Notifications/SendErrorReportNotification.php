<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

use App\User;

class SendErrorReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->data = $request->all();
        $this->user = $request->user();
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
            ->greeting('Hello!')
            ->line($this->user ? $this->user->name : 'Anonymous user' . ' reported an error '. $this->data['status'] . ' ' . $this->data['statusText'] .':')
            ->line($this->data['error']['exception'])
            ->line($this->data['error']['message'])
            ->line($this->data['error']['file'] . ' at ' . $this->data['error']['line']);
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
            'error' => $this->data,
            'user' => $this->user ?: 'Anonymous user'
        ];
    }
}
