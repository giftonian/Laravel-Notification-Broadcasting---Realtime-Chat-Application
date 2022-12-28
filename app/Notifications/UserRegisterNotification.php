<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\CarbonInterface;
use Illuminate\Notifications\Messages\SlackMessage;

class UserRegisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( 
        public readonly string $name,
        public readonly string $email,
        public readonly string $subject,
        public readonly string $message
    
    /*,

    public readonly CarbonInterface $datetime*/) 
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
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
                    ->subject($this->subject)
                    ->greeting("Hi, {$this->name} !")
                    ->line($this->message)
                    //->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSlack(mixed $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->success()
            ->content("{$this->name} newly registered with LaravelChat application.");
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
            //
        ];
    }
}
