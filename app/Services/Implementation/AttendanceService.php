<?php

namespace App\Services\Implementation;

use App\Adapter\INotification;
use App\Repositories\IAttendance;
use App\Repositories\INotificationRepository;
use App\Repositories\IUser;
use App\Services\IAttendanceService;
use Carbon\Carbon;

class AttendanceService implements IAttendanceService
{
    protected $attendanceRepository;
    protected $userRepository;
    protected $notificationAdapter;

    protected $notificationRepository;

    public function __construct(IAttendance   $attendanceRepository, IUser $userRepository,
                                INotification $notificationAdapter, INotificationRepository $notificationRepository)
    {
        $this->attendanceRepository   = $attendanceRepository;
        $this->userRepository         = $userRepository;
        $this->notificationAdapter    = $notificationAdapter;
        $this->notificationRepository = $notificationRepository;
    }


    public function checkIn($userId)
    {
        return $this->attendanceRepository->checkIn($userId);
    }

    public function checkOut($userId)
    {
        return $this->attendanceRepository->checkOut($userId);
    }

    public function getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate)
    {
        return $this->attendanceRepository->getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate);

    }


    public function calculateNumberOfHoursInWorking($attendance)
    {
        if ($attendance->check_out && is_null($attendance->number_working_hours))
        {
            $checkIn  = Carbon::parse($attendance->check_in);
            $checkOut = Carbon::parse($attendance->check_out);

            // Ensure check-out is after check-in, otherwise swap them to avoid negative time
            if ($checkOut->lt($checkIn)) {
                [$checkIn, $checkOut] = [$checkOut, $checkIn];
            }

            // Calculate total working seconds and convert to hours
            $numberWorkingSeconds = $checkOut->diffInSeconds($checkIn);
            $numberHours          = $numberWorkingSeconds / 3600;  // Convert to hours

            $numberWorkingHours = $numberHours;
            $numberWorkingHours = round($numberWorkingHours, 3);

            // Save the updated number_working_hours
            $this->attendanceRepository->updateNumberWorkingHours($attendance, $numberWorkingHours);
            return true;
        }
    }

    public function sendMonthlyWorkHoursNotification()
    {
        $users     = $this->userRepository->getUsers();
        $startDate = now()->subMonth()->startOfMonth();
        $endDate   = now()->subMonth()->endOfMonth();

        foreach ($users as $user)
        {
            $hoursWorkedInMonth = $this->getTotalHoursBetweenTwoDates($user->id, $startDate, $endDate);
            $message            = 'You worked a total of ' . $hoursWorkedInMonth . ' hours last month.';

            // Send notification
            $this->notificationAdapter->send($user->email, $message);

            $this->notificationRepository->createNotification($user->id, $message);
        }
        return true;
    }
}