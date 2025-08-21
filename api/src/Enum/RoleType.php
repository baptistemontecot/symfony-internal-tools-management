<?php

namespace App\Enum;

enum RoleType:string
{
    case EMPLOYEE = 'employee';
    case MANAGER = 'manager';
    case ADMIN = 'admin';
}
