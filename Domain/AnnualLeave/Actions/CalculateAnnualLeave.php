<?php

namespace Domain\AnnualLeave\Actions;

use App\Enums\LeaveTypes;
use Domain\BaseAction;
use Illuminate\Support\Carbon;

class CalculateAnnualLeave extends BaseAction
{
    public function totalWorkingMonths()
    {
        return Carbon::parse($this->jobStartDate())->diffInMonths(Carbon::now());
    }

    public function jobStartDate()
    {
        return data_get($this->data, 'job_start_date', null);
    }

    public function totalLeaveDaysBeforeDeduction()
    {
        return multiply($this->totalWorkingMonths(), LeaveTypes::LEAVE_DAYS_PER_MONTH);
    }

    public function totalLeaveDaysAfterDeduction()
    {
        return difference($this->totalLeaveDaysBeforeDeduction(), $this->annualDaysUsed());
    }

    public function annualDaysUsed()
    {
        return data_get($this->data, 'days_taken_before', null);
    }
}
