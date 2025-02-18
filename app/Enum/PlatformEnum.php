<?php

namespace App\Enum;

enum PlatformEnum: string
{
    case NEWSAPI = 'newsapi';
    case GUARDIAN = 'guardian';
    case NYT = 'new-york-times';
}

