<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Quotationuser extends Notification 
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * SendProviderActivationEmail constructor.
     *
     * @param $token
     */
    public function __construct($demo,$user)
    {
        $this->demo = $demo;
         $this->user = $user;
    }
   

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->subject("quotation")
            ->greeting("Hello {$notifiable->name},")
            ->line("Quotation with reference number {$this->demo->quotation_no[0]} has been created successfully and sent an email to client on {$this->user->email}.")
            ->line(new HtmlString("Thanks,<br>System."));
        return $message;
    }
}
