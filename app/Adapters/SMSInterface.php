<?php

namespace App\Adapters;

interface SMSInterface
{
    public function sendMessage($to, $message);
}
