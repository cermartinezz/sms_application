<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'to',
        'message',
        'from'
    ];

    public function response(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SendMessage::class,'message_id','id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'from' => $this->from,
            'success' => $this->response ? $this->response->success : null,
            'response' => $this->response ? $this->response->toArray() : [],
            'date' => $this->created_at
        ];
    }


}
