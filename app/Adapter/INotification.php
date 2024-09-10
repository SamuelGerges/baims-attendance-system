<?php

namespace App\Adapter;

use App\Models\User;

interface INotification
{
    public function send($recipient, $message): bool;

}