<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

class Twilio
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toTwilio($notifiable);
        \Log::info('Offer', $notifiable->toArray());
        \Log::info('Data', $data);
        send_sms($data['to'], $data['message']);
        // Send notification to the $notifiable instance...
    }
}
