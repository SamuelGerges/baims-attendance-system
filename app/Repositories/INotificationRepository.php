<?php

namespace App\Repositories;

interface INotificationRepository
{
    public function createNotification($userId, $message);
}