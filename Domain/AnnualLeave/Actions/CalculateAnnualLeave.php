<?php

namespace Domain\AnnualLeave\Actions;

use Carbon\CarbonPeriod;
use Domain\BaseAction;
use Illuminate\Support\Carbon;

class CalculateAnnualLeave extends BaseAction
{
    public function getTotalWorkingMonths()
    {
        $result = CarbonPeriod::create($this->jobStartDate(), '1 month', Carbon::now());
    }

    public function jobStartDate()
    {
        return data_get($this->data, 'job_start_date', null);
    }
}
