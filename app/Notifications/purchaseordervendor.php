<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Purchaseordervendor extends Notification 
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
        $message->subject("Purchaseorder")
            // ->greeting('Hi '.$notifiable->first_name.' '.$notifiable->last_name.',')
            ->greeting("Hello {$notifiable->name},")
            ->line("We have create the Purchase order for your requirement.")
            ->line("Please find attached files for the same and Kindly provide us this materials before {$this->demo->delivery_date}")
            ->line(new HtmlString("Thanks,<br>System."));
        return $message;
    }
}

