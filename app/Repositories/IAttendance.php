<?php

namespace App\Repositories;

interface IAttendance
{
    public function checkIn($userId);

    public function checkOut($userId);

    public function updateNumberWorkingHours($attendance, $numberWorkingHours);

    public function getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate);

}