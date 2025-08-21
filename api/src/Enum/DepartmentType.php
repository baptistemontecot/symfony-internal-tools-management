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
}
