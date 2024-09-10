<?php


namespace App\Adapter\Implementation;

use App\Adapter\INotification;
use Illuminate\Support\Facades\Mail;

class EmailNotificationAdapter implements INotification
{
    public function send($recipient, $message): bool
    {
        try {
            Mail::raw($message, function ($mail) use ($recipient) {
                $mail->to($recipient)
                    ->subject('Monthly Work Hours Report');
            });
            return true;

        } catch (\Exception $exception) {
            return false;
        }

    }
}