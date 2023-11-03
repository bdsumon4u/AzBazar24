<?php

namespace App\Notifications\User;

use App\Notifications\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class OrderPlaced extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SMSChannel::class];
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
            ->markdown('emails.order-placed');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $code = Cache::remember('order:confirm:'.$this->order->id, 5*60, function () {
            return mt_rand(1000, 999999);
        });
        return [
            'message' => 'Your order has been received. Invoice number is '.$this->order->id.'. If you have any query please contact with us .01755661181. Thanks by azbazar24.com',
            //'msg' => 'An order has been placed at '.config('app.name').'. Order ID: '.$this->order->id.'. To login your account, click: '.url('auth'),
        ];
    }
}
