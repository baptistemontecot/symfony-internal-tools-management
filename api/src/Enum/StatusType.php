<?php

namespace App\Enum;

enum StatusType: string
{
    case ACTIVE = 'active';
    case DEPRECATED = 'deprecated';
    case TRIAL = 'trial';
    case REVOKED = 'revoked';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values());
    }
}
