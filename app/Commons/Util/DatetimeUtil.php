<?php

namespace App\Commons\Util;

use Carbon\Carbon;

class DatetimeUtil
{

    public static function formatDateTime(string $value) : ?string
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i'): null;
    }

    public static function nowTimestamp() : ?string
    {
        return Carbon::now()->timestamp;
    }


}
