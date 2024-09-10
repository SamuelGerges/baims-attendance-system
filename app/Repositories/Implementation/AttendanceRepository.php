<?php

namespace App\Repositories\Implementation;

use App\Models\Attendance;
use App\Repositories\IAttendance;

class AttendanceRepository implements IAttendance
{
    public function checkIn($userId)
    {
        $existingAttendance = Attendance::query()
            ->where('user_id', '=', $userId)
            ->whereDate('date', now()->format('Y-m-d'))  // Ensure it checks today's date
            ->whereNotNull('check_in')
            ->whereNull('check_out')  // Ensure check-out is not made yet
            ->first();

        if ($existingAttendance) {
            return false;
        }

        // Create a new attendance record for the authenticated user
        return Attendance::query()->create([
            'user_id'              => $userId,
            'date'                 => now()->format('Y-m-d'),
            'check_in'             => now()->format('H:i:s'),
            'check_out'            => null,
            'number_working_hours' => null,
        ]);
    }

    public function checkOut($userId)
    {
        // Get the latest check-in record for the user
        $attendance = Attendance::query()
            ->where('user_id', '=', $userId)
            ->whereDate('date', now()->format('Y-m-d'))
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->orderBy('created_at', 'desc') // Explicit ordering
            ->first();

        if (!$attendance) {
            return false;
        }

        $attendance->check_out = now()->format('H:i:s');
        $attendance->save();

        return $attendance;
    }


    public function updateNumberWorkingHours($attendance, $numberWorkingHours)
    {
        $attendance->update([
            'number_working_hours' => $numberWorkingHours,
        ]);
    }


    public function getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate)
    {
        return Attendance::query()
            ->where('attendances.user_id', $userId)
            ->whereBetween('date', [$fromDate, $toDate])
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->sum('attendances.number_working_hours');
    }
}