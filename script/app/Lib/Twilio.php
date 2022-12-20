<?php

namespace App\Lib;

use Twilio\Rest\Client;
use App\Lib\TraitShortLink;

class Twilio
{
    use TraitShortLink;

    private $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    public function send(string $phoneNumber, string $message)
    {
        $this->client->messages->create(
            $phoneNumber,
            array(
                "messagingServiceSid" => env('TWILIO_MESSAGE_SERVICE'),
                'body' => $message
            )
        );
    }

    public function sendLink(string $phoneNumber, string $business, string $amount, string $link)
    {
        $this->send(
            $phoneNumber,
            __('Twilio.Message.SMS', [
                'business' => $business,
                'amount' => $amount,
                'link' => $this->saveShortLink($link)
            ])
        );
    }
}
