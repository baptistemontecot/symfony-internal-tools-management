<?php

namespace App\Enum;

enum DepartmentType: string
{
    case ENGINEERING = 'Engineering';
    case SALES = 'Sales';
    case MARKETING = 'Marketing';
    case HR = 'HR';
    case FINANCE = 'Finance';
    case OPERATIONS = 'Operations';
    case DESIGN = 'Design';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values());
    }
}
