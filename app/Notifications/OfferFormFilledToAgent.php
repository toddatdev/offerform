<?php

namespace App\Notifications;

use App\Models\OfferForms\OfferFormOffer;
use App\Notifications\Channels\Twilio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferFormFilledToAgent extends Notification
{
    use Queueable;

    private $offer;
    private $mailjetTemplateId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer, $mailjetTemplateId = 3792051)
    {
        $this->offer = $offer;
        $this->mailjetTemplateId = $mailjetTemplateId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database'];

        $preferences = $notifiable->notification_preferences;
        if (isset($preferences['email']) && $preferences['email']) {
            mailjet_send_email_by_template([
                'Email' => $notifiable->getEmailForPasswordReset(),
                'Name' => $notifiable->full_name,
            ], $this->mailjetTemplateId, [
                'offer_form_completed_link' => route('dash.offer-forms.completed.show', $this->offer->slug)
            ]);

//            $via[] = 'mail'; transaction_coordinator_email
        }

        if (isset($preferences['tc_email']) && $preferences['tc_email'] &&
            isset($notifiable->other_inputs['transaction_coordinator_email']) &&
            filter_var($notifiable->other_inputs['transaction_coordinator_email'], FILTER_VALIDATE_EMAIL)
        ) {
            mailjet_send_email_by_template([
                'Email' => $notifiable->other_inputs['transaction_coordinator_email'],
                'Name' => 'Transaction Coordinator',
            ], $this->mailjetTemplateId, [
                'offer_form_completed_link' => route('dash.offer-forms.completed.show', $this->offer->slug)
            ]);
        }

        if (isset($preferences['text']) && $preferences['text']) {
            $via[] = Twilio::class;
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You received new offer.')
            ->action('View Offer', route('dash.offer-forms.completed.show', $this->offer->slug))
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        $variables = $this->offer->variables ?? [];
        return [
            'property_address' => $variables[OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? '',
            'buyer_name'       => ($variables[OfferFormOffer::VAR_BUYER_FIRST_NAME] ?? $variables[OfferFormOffer::VAR_FORM_FIRST_NAME] ?? ' - ') . ' ' .
                ($variables[OfferFormOffer::VAR_BUYER_LAST_NAME] ?? $variables[OfferFormOffer::VAR_FORM_LAST_NAME] ?? ' - '),
            'offer_form_name'  => $this->offer->offerForm->name,
            'agent_name'       => $this->offer->user->full_name,
            'link_to_offer'             => route('dash.offer-forms.completed.show', $this->offer->slug),
        ];
    }

    /**
     * Get the array representation of the notification for twilio.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toTwilio($notifiable)
    {
        return [
            'to'      => $notifiable->phone,
            'message' => trim(<<<EOF
                OfferForm Filled out!
                New offerform filled out please login to your account to view!
EOF
            ),

        ];
    }
}
