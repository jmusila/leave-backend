<?php

namespace Domain\AnnualLeave\Actions;

use Domain\BaseAction;
use Illuminate\Support\Carbon;

class CalculateAnnualLeave extends BaseAction
{
    public const LEAVE_DAYS_PER_MONTH = 1.75;

    public function totalWorkingMonths()
    {
        return Carbon::parse($this->jobStartDate())->diffInMonths(Carbon::now());
    }

    public function jobStartDate()
    {
        return data_get($this->data, 'job_start_date', null);
    }

    public function totalLeaveDays()
    {

    }
}
