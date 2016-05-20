<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait DateFormatterTrait
{
    public function getFormattedDate($date, $tz, $format = 'Iso8601String')
    {
        return Carbon::parse($date, $tz)->{'to' . $format}();
    }
}
