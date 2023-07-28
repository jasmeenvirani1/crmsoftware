<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Purchaseorderuser extends Notification 
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
        //echo($this->demo->id);
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
            ->line("Purchase Order with reference number {$this->demo->po_no} has been created successfully and sent an email to Vendor with name {$this->demo->vendor->name} on his email id {$this->demo->vendor->email}")
            ->line(new HtmlString("Thanks,<br>System."));

        return $message;
    }
}

