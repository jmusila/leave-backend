<?php

namespace Domain\AnnualLeave\Actions;

use App\Enums\LeaveTypes;
use Domain\BaseAction;
use Illuminate\Support\Carbon;

class CalculateAnnualLeave extends BaseAction
{
    public function totalWorkingMonths(): int
    {
        return Carbon::parse($this->jobStartDate())->diffInMonths(Carbon::now());
    }

    public function jobStartDate(): string
    {
        return data_get($this->data, 'job_start_date', null);
    }

    public function totalLeaveDaysBeforeDeduction(): int
    {
        return multiply($this->totalWorkingMonths(), LeaveTypes::LEAVE_DAYS_PER_MONTH);
    }

    public function totalLeaveDaysAfterDeduction(): int
    {
        return difference($this->totalLeaveDaysBeforeDeduction(), $this->annualDaysUsed());
    }

    public function annualDaysUsed(): int
    {
        return data_get($this->data, 'days_taken_before', null);
    }
}
