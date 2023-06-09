<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendMessage extends Model
{
    protected $table = 'send_messages';
    protected $fillable = [
        'success',
        'confirmation',
        'message_id',
        'date_sent',
        'error_message'
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'success' => $this->success,
            'confirmation' => $this->confirmation,
            'message_id' => $this->message_id,
            'date_sent' => $this->date_sent,
            'error_message' => $this->error_message,
        ];
    }


}
