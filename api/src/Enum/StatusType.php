<?php

namespace App\Enum;

enum StatusType: string
{
    case ACTIVE = 'active';
    case DEPRECATED = 'deprecated';
    case TRIAL = 'trial';
    case REVOKED = 'revoked';
}
