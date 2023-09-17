<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case PENDING = 'Pending';
    case EXPIRED = 'Expired';


    public static function getNames(): array
    {
        return [
            self::ACTIVE->value => __('general.status.active'),
            self::INACTIVE->value => __('general.status.inactive'),
            self::PENDING->value => __('general.status.pending'),
            self::EXPIRED->value => __('general.status.expired'),
        ];
    }
}
