<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponsesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\DateValidationRequest;
use App\Services\IAttendanceService;
use Illuminate\Http\Response;

class   AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(IAttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }


    public function checkIn()
    {
        $userId     = auth()->user()->id;
        $attendance = $this->attendanceService->checkIn($userId);

        if(!is_object($attendance))
        {
            return ResponsesHelper::returnError(Response::HTTP_NOT_ACCEPTABLE, 'this user made a check-in before.');
        }

        return ResponsesHelper::returnSuccessMessage(Response::HTTP_OK , 'User check-in Successfully');

    }


    public function checkOut()
    {
        $userId     = auth()->user()->id;
        $attendance = $this->attendanceService->checkOut($userId);

        if(!is_object($attendance))
        {
            return ResponsesHelper::returnError(Response::HTTP_NOT_FOUND, 'This user did not check in before.');
        }

        $this->attendanceService->calculateNumberOfHoursInWorking($attendance);

        return ResponsesHelper::returnSuccessMessage(Response::HTTP_OK , 'User check-out Successfully');
    }


    public function getTotalHoursBetweenTwoDates(DateValidationRequest $request)
    {
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $userId   = auth()->user()->id;

        $numberHours = $this->attendanceService->getTotalHoursBetweenTwoDates($userId, $fromDate, $toDate);
        return ResponsesHelper::returnData($numberHours , 'Number Hours For User',200);

    }
}
