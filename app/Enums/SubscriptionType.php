<?php

namespace App\Enums;

enum SubscriptionType: string
{
    case UPGRADE = 'upgrade';
    case DOWNGRADE = 'downgrade';

    case SUBSCRIBE = 'subscribe';

    public static function getNames(): array
    {
        return [
            self::UPGRADE->value => __('general.upgrade'),
            self::DOWNGRADE->value => __('general.downgrade'),
            self::SUBSCRIBE->value => __('general.subscribe'),
        ];
    }
}
