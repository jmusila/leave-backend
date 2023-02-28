<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAnnualLeaveRequest;
use Domain\AnnualLeave\Actions\CalculateAnnualLeave;
use Illuminate\Http\Request;

class LeaveCalculatorController extends Controller
{
    public function annualLeaveCalculator(GetAnnualLeaveRequest $request, CalculateAnnualLeave $calculateAnnualLeave)
    {
        $totalDaysAfterDeduction = $calculateAnnualLeave->fromData($request->validated())->totalLeaveDaysAfterDeduction();

        $totalDaysTaken = $calculateAnnualLeave->annualDaysUsed();

        $dayStartedWorking = $calculateAnnualLeave->jobStartDate();
    }
}
