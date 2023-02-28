<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAnnualLeaveRequest;
use Domain\AnnualLeave\Actions\CalculateAnnualLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LeaveCalculatorController extends Controller
{
    public function annualLeaveCalculator(GetAnnualLeaveRequest $request, CalculateAnnualLeave $calculateAnnualLeave)
    {
        $totalDaysAfterDeduction = $calculateAnnualLeave->fromData($request->validated())->totalLeaveDaysAfterDeduction();

        $totalDaysTaken = $calculateAnnualLeave->annualDaysUsed();

        $dayStartedWorking = $calculateAnnualLeave->jobStartDate();

        return response()->json([
            'total_days_after_deduction' => $totalDaysAfterDeduction,
            'total_days_taken' => $totalDaysTaken,
            'job_start_date' => Carbon::parse($dayStartedWorking)->diffForHumans()
        ]);
    }
}
