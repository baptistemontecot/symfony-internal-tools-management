<?php

namespace App\Enum;

enum CategoryType: string
{
    case COMMUNICATION = 'Communication';
    case DEVELOPMENT = 'Development';
    case DESIGN = 'Design';
    case PRODUCTIVITY = 'Productivity';
    case Analytics = 'Analytics';
    case SECURITY = 'Security';
    case MARKETING = 'Marketing';
    case HR = 'HR';
    case FINANCE = 'Finance';
    case INFRASTRUCTURE = 'Infrastructure';
}
