<?php

namespace App\Services;

use App\Adapters\MessageInterface;
use App\Models\Message;
use App\Models\SendMessage;
use Illuminate\Database\DatabaseManager;

class GuestMessageServices
{
    protected DatabaseManager $db;
    private MessageInterface $messageClient;

    public function __construct(DatabaseManager $databaseManager, MessageInterface $messageClient)
    {
        $this->db = $databaseManager;
        $this->messageClient = $messageClient;
    }

    /**
     * @throws \Throwable
     */
    public function createMessages($data, $session)
    {
        $data_to_save = array_map(function ($number) use ($data,$session) {
            return [
                'to' => $number,
                'message' => $data['message'],
                'from' => $session->id
            ];
        }, $data['numbers']);

        $messages = $this->db->transaction(function () use ($data_to_save){
            $messages = array_map(function ($message) {
                return Message::query()->create($message);
            },$data_to_save);

            $messageResponses = $this->messageClient->sendMessage($messages);

            $data = array_map(function ($responseMessage) {
                return SendMessage::query()->create($responseMessage);
            },$messageResponses);

            return $messages;
        });

        return $messages;
    }
}
