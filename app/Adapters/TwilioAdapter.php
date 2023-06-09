<?php

namespace App\Adapters;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\RestException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioAdapter implements MessageInterface
{
    private $client;

    /**
     * @throws TwilioException
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->client =  $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    }

    public function sendMessage($messages): array
    {
        return array_map(function ($message){
            try {
                $twilio_response = $this->client->messages->create(
                    $message->to,
                    [
                        'from' => env('TWILIO_NUMBER'),
                        'body' => $message->message,
                    ]
                );


                return [
                    'success' => true,
                    'confirmation' => $twilio_response->sid,
                    'message_id' => $message->id,
                    'date_sent' => $twilio_response->dateCreated,
                    'error_message' => null,
                ];
            } catch (RestException $e) {
                return [
                    'success' => false,
                    'confirmation' => $e->getCode(),
                    'message_id' => $message->id,
                    'date_sent' => null,
                    'error_message' => $e->getMessage()
                ];
            }
        }, $messages);
    }
}
