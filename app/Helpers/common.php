<?php

use Carbon\Carbon;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;
use SevenShores\Hubspot\Factory;
use Twilio\Rest\Client;

if (!function_exists('today_interest_rate')) {
    function today_interest_rate($offerAmount = 0, $downPayment = 0): float
    {
        $offerAmount = sanitize_number_int($offerAmount);
        $downPayment = sanitize_number_int($downPayment);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mortgageapi.zillow.com/getRates?partnerId=RD-SBWLSKG&queries.default.stateAbbreviation=CA&queries.default.propertyBucket.propertyValue={$offerAmount}&queries.default.propertyBucket.loanAmount={$downPayment}&queries.default.creditScoreBucket=VeryHigh",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            $responseData = json_decode($response, true);

            foreach ($responseData['rates']['default']['samples'] as $value) {
                $timezone = 'America/Los_Angeles';

                $date = Carbon::parse($value['time'])->format('Y-m-d', $timezone);

                if ($date === Carbon::today($timezone)->format('Y-m-d')) {
                    return round($value['rate'], 2);
                }
            }
        }

        return 0.00;
    }
}

if (!function_exists('next_display_order')) {
    function next_display_order($query)
    {
        $next = $query->selectRaw('IFNULL(MAX(display_order) + 1, 1) as display_order')->first();
        return $next['display_order'];
    }
}

if (!function_exists('sanitize_number_int')) {
    function sanitize_number_int($value): int
    {
        return (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
}

if (!function_exists('reorder_display_order')) {
    function reorder_display_order($reorderModel, $sortOrders)
    {
        foreach ($sortOrders as $sortOrder) {
            $model = $reorderModel::find($sortOrder['value']);
            if ($model) {
                $model->update(['display_order' => $sortOrder['order']]);
            }
        }
    }
}

if (!function_exists('get_class_name')) {
    function get_class_name($obj): bool|int|string|null
    {
        $classname = get_class($obj);
        if ($pos = strrpos($classname, '\\')) $classname = substr($classname, $pos + 1);
        else $classname = $pos;

        return \Illuminate\Support\Str::plural(strtolower($classname));
    }
}

if (!function_exists('send_sms')) {
    /**
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    function send_sms($recipients, $body)
    {
        if (!$recipients) return null;

        $accountSid = config("services.twilio.account_sid");
        $authToken = config("services.twilio.auth_token");
        $twilioPhoneNumber = config('services.twilio.phone_number');

        try {
            $client = new Client($accountSid, $authToken);
            return $client->messages->create($recipients,
                [
                    'messagingServiceSid' => config('services.twilio.service_sid'),
//                    'from' => $twilioPhoneNumber,
                    'body' => $body
                ]);
        } catch (\Exception $e) {
            Log::error('Send SMS (Twilio): ' . $e->getMessage(), $e->getTrace());
            return null;
        }

    }
}

if (!function_exists('mailjet_send_email_by_template')) {

    function mailjet_send_email_by_template($recipients, $templateId, $variables = [])
    {
        $messages = [
            'FromEmail' => config('mail.from.address'),
            'FromName' => config('mail.from.name'),
            'Recipients' => [
                0 => $recipients
            ],
            'Subject' => '-',
            'Mj-TemplateID' => $templateId,
            'Mj-TemplateLanguage' => true,
            'Vars' => $variables
        ];

        try {
            logger()->info('Mailjet Data: ', [$messages]);
            return Mailjet::post(Resources::$Email, [
                'body' => [
                    'Messages' => [
                        0 => $messages,
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            logger()->error('Mailjet', [$e->getMessage()]);
            return null;
        }

    }
}

//
//if (!function_exists('youtube_url')) {
//
//    function parse_youtube_url($url)
//    {
//        $url = "http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=related";
//        $parse = parse_url($url, PHP_URL_QUERY);
//        parse_str($parse, $output);
//        echo $output['watch'];
//    }
//}


//if (!function_exists('hubspot_create_contact')) {
//
//    function hubspot_create_contact($data)
//    {
//        try {
//            $client = Factory::createWithOAuth2Token(config('services.hubspot.api_key'));
//
//            $properties = [
//                "company" => "-",
//                "email" => $data['email'],
//                "firstname" => $data['first_name'],
//                "lastname" => $data['last_name'],
//                "phone" => "-",
//                "website" => "-"
//            ];
//            $response = $client->contacts()->create(['properties' => $properties]);
//            print_r($response);
//        } catch (\SevenShores\Hubspot\Exceptions\HubspotException $e) {
//            echo "Exception when calling basic_api->create: ", $e->getMessage();
//        }
//    }
//}

