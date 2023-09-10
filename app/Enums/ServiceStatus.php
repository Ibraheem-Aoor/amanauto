<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';

    public static function getNames(): array
    {
        return [
            self::ACTIVE->value => __('general.status.active'),
            self::INACTIVE->value => __('general.status.inactive'),
        ];
    }
}
