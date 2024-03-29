<?php

namespace App;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class DateRangeHelper
{
    // UPACARAKU
    public static function parseDateRange($dateRange)
    {
        $parseDate = Str::of($dateRange)->explode(' - ');
        $startDate = Carbon::createFromFormat('d M Y', $parseDate[0])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d M Y', $parseDate[1])->format('Y-m-d');
        return [$startDate, $endDate];
    }

    // DETAIL RESERVASI
    public static function parseDateRangeTime($dateRange)
    {
        $parseDate = Str::of($dateRange)->explode(' - ');
        $startDate = Carbon::createFromFormat('d M Y H:i', $parseDate[0])->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('d M Y H:i', $parseDate[1])->format('Y-m-d H:i:s');
        return [$startDate, $endDate];
    }

    // TANGGAL TANGKIL
    public static function parseSingleDate($date)
    {
        $startDate = Carbon::createFromFormat('d M Y H:i', $date)->format('Y-m-d H:i:s');
        return $startDate;
    }

    public static function defaultSingleDate($date)
    {
        $result = Carbon::createFromFormat('d M Y', $date);
        return $result;
    }

}
