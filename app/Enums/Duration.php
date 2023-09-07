<?php

namespace App\Enums;

enum Duration: string
{
    case DAY = 'Day';
    case MONTH = 'Month';
    case YEAR = 'Year';

    public static function getNames(): array
    {
        return [
            self::DAY->value => __('general.Day'),
            self::MONTH->value => __('general.Month'),
            self::YEAR->value => __('general.Year'),
        ];
    }
}
