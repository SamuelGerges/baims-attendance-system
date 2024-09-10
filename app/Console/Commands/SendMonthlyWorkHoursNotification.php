<?php

namespace App\Console\Commands;

use App\Services\Implementation\AttendanceService;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class SendMonthlyWorkHoursNotification extends Command
{

    protected $signature = 'notify:work-hours';

    protected $description = 'Send a notification with the total number of hours worked in the previous month';

    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        parent::__construct();
        $this->attendanceService   = $attendanceService;
    }

    public function handle()
    {
        $notify = $this->attendanceService->sendMonthlyWorkHoursNotification();

        if ($notify == true) {
            $this->info('Notification sent successfully.');
        } else {
            $this->info('Notification sent failed. Please try again later.');
        }

    }
}
