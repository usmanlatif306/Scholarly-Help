<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfullLoginNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Welcome to Scholarly Help, Place Your First Order Now!')
            ->greeting('Hi ' . $this->user->first_name . ' ' . $this->user->last_name . '!')
            ->line('Welcome to Scholarly Help – we’re excited to serve you!')
            ->line('You’re all ready to go!')
            ->line('Scholarly Help makes it easier for students to complete their homework, assignments, online exams, and classes within due time. We provide the most reliable academic writing services with more flexibility and insight to power users through customizable services that enable you to get in touch with the experts of your relevant subjects. You can contact us 24/7 and get an immediate response.')
            ->action('Place your First Order', route('order_page'))
            ->line('For more information about Scholarly Help including ordering procedure and pricing, visit official https://scholarlyhelp.com.');
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
