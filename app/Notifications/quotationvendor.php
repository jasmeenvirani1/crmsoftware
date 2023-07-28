<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Quotationvendor extends Notification 
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
    public function __construct($demo)
    {
        $this->demo = $demo;
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
            ->line("We have create the quotation for your requirement")
            ->line("Please find attached files for the same.")
            ->line(new HtmlString("Thanks,<br>{$this->demo->customer->name}."));
            

        return $message;
    }
}
