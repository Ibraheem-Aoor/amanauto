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
            self::DAY->value => __('general.day'),
            self::MONTH->value => __('general.month'),
            self::YEAR->value => __('general.year'),
        ];
    }
}
