<?php

namespace App;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class DateRangeHelper
{

    public static function parseDateRange($dateRange)
    {
        $parseDate = Str::of($dateRange)->explode(' - ');
        $startDate = Carbon::createFromFormat('d/m/Y g:i A', $parseDate[0])->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('d/m/Y g:i A', $parseDate[1])->format('Y-m-d H:i:s');
        return [$startDate, $endDate];
    }

}
