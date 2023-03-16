<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum InvalidKeyboardShortcut: string
{
    use EnumToArray;

    case CTRL_W = 'CTRL + W';
    case CTRL_T = 'CTRL + T';
    case CTRL_N = 'CTRL + N';
    case CTRL_P = 'CTRL + P';
    case CTRL_C = 'CTRL + C';
    case CTRL_V = 'CTRL + V';
    case CTRL_F = 'CTRL + F';
}
