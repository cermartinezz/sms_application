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


}
