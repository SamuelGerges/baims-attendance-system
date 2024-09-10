<?php

namespace App\Services;

interface IAttendanceService
{
    public function checkIn($userId);
    public function checkOut($userId);
    public function calculateNumberOfHoursInWorking($attendance);
    public function getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate);

    public function sendMonthlyWorkHoursNotification();

}