<?php

namespace App\Repositories\Implementation;

use App\Models\Notification;
use App\Repositories\INotificationRepository;

class NotificationRepository implements INotificationRepository
{

    public function createNotification($userId, $message)
    {
        return Notification::query()->create([
            'user_id' => $userId,
            'message' => $message,
            'send_at' => now(),
        ]);
    }


}