<?php

namespace App\Enums;

enum VatType: string
{
    case PERCENT = 'percent';
    case FLAT = 'flat';

    public static function getNames(): array
    {
        return [
            self::PERCENT->value => __('general.percent'),
            self::FLAT->value => __('general.flat'),
        ];
    }
}
