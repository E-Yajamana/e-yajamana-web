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
        $startDate = Carbon::createFromFormat('d M Y', $parseDate[0])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d M Y', $parseDate[1])->format('Y-m-d');
        return [$startDate, $endDate];
    }

    public static function parseDateRangeTime($dateRange)
    {
        $parseDate = Str::of($dateRange)->explode(' - ');
        $startDate = Carbon::createFromFormat('d M Y g:i A', $parseDate[0])->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('d M Y g:i A', $parseDate[1])->format('Y-m-d H:i:s');
        return [$startDate, $endDate];
    }

    public static function parseSingleDate($date)
    {
        $startDate = Carbon::createFromFormat('d M Y g:i A', $date)->format('Y-m-d H:i:s');
        return $date;
    }

}
