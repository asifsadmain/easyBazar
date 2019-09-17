<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyDM extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
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
    public function toDatabase($notifiable)
    {
        return [
            'notificationTime' => Carbon::now(),
            'notificationType' => "NotifyDM",
            'sender_id' => auth()->user()->id,
            'sender_name' => auth()->user()->name,
            'sender_address' => auth()->user()->address,
            'buyer_id' => $this->details['buyer_id'],
            'buyer_name' => $this->details['buyer_name'],
            'buyer_address' => $this->details['buyer_address'],
            'product_id' => $this->details['product_id'],
            'product_name' => $this->details['product_name'],
            'order_id' => $this->details['order_id']
        ];
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
