<?php

declare(strict_types=1);

namespace App\Enum;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DELETED = 'deleted';
}