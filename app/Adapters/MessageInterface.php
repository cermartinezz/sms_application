<?php

namespace App\Adapters;

interface MessageInterface
{
    public function sendMessage(array $messages);
}
