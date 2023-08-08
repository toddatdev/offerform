<?php

namespace App\Notifications;

use App\Models\OfferForms\OfferFormOffer;
use App\Notifications\Channels\Twilio as TwilioChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Magarrent\LaravelUrlShortener\Models\UrlShortener;

class SendOfferFormToBuyer extends Notification
{
    use Queueable;

    private $linkToSend;
    private $viaChannel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($linkToSend, $viaChannel = 'mail')
    {
        $this->linkToSend = $linkToSend;
        $this->viaChannel = $viaChannel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $firstBuyerName = $notifiable->getVariable(OfferFormOffer::VAR_BUYER_FIRST_NAME) . ' ' . $notifiable->getVariable(OfferFormOffer::VAR_BUYER_LAST_NAME);

        $secondBuyerName = $notifiable->getVariable(OfferFormOffer::VAR_ADDITIONAL_BUYER_FIRST_NAME) . ' ' . $notifiable->getVariable(OfferFormOffer::VAR_ADDITIONAL_BUYER_LAST_NAME);

        if (trim($secondBuyerName) !== '') $firstBuyerName = trim($firstBuyerName) . ' and ' . trim($secondBuyerName);

        $message = str_replace([
            '%agent_name%',
            '%property_address%',
            '%agent_name%',
            '%agent_number%',
            '%offer_form_link%',
        ], [
            trim($notifiable->user->full_name),
            $notifiable->getVariable(OfferFormOffer::VAR_PROPERTY_ADDRESS),
            trim($notifiable->user->full_name),
            $notifiable->user->phone ?? '',
            "<a href='$this->linkToSend'>$this->linkToSend</a>"
        ],"Your agent %agent_name% has sent you an OfferForm to fill out. This will help streamline the purchase of your new property at %property_address%. Any questions reach out to %agent_name% at %agent_number%. Please click the link to get started. %offer_form_link%");


        return (new MailMessage)
            ->greeting(str_replace('%buyer_name%', $firstBuyerName, 'Hello %buyer_name%,'))
            ->subject('OfferForm')
            ->line(new HtmlString($message))
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification for twilio.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toTwilio($notifiable)
    {
        $firstBuyerName = $notifiable->getVariable(OfferFormOffer::VAR_BUYER_FIRST_NAME) . ' ' . $notifiable->getVariable(OfferFormOffer::VAR_BUYER_LAST_NAME);

        $secondBuyerName = $notifiable->getVariable(OfferFormOffer::VAR_ADDITIONAL_BUYER_FIRST_NAME) . ' ' . $notifiable->getVariable(OfferFormOffer::VAR_ADDITIONAL_BUYER_LAST_NAME);

        if (trim($secondBuyerName) !== '') $firstBuyerName = trim($firstBuyerName) . ' and ' . trim($secondBuyerName);

        $message = str_replace([
            '%buyer_name%',
            '%agent_name%',
            '%property_address%',
            '%agent_name%',
            '%agent_number%',
            '%offer_form_link%',
        ], [
            $firstBuyerName,
            trim($notifiable->user->full_name),
            $notifiable->getVariable(OfferFormOffer::VAR_PROPERTY_ADDRESS),
            trim($notifiable->user->full_name),
            $notifiable->user->phone ?? '',
            UrlShortener::generateShortUrl($this->linkToSend)
        ],"Hello %buyer_name%, your agent %agent_name% has sent you an OfferForm to fill out. This will help streamline the purchase of your new property at %property_address%. Any questions reach out to %agent_name% at %agent_number%. Please click the link to get started. %offer_form_link% (Responses sent to this number will not be seen)");

        return [
            'to' => $notifiable->phone,
            'message' => trim($message)
        ];
    }
}
