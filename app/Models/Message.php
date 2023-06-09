<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'to',
        'message',
        'date',
        'from'
    ];

    public function response(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SendMessage::class,'message_id','id');
    }

}
