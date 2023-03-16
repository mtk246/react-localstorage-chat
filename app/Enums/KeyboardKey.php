<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum KeyboardKey: string
{
    use EnumToArray;

    case KEY_CTRL = 'CTRL';
    case KEY_ALT = 'ALT';
    case KEY_SHIFT = 'Shift';
    case KEY_CMD = 'CMD';
    case KEY_ESC = 'ESC';
    case KEY_SPACE = 'Space';
    case KEY_BACKSPACE = 'Backspace';
    case KEY_PLUS = 'Plus';
    case KEY_F1 = 'F1';
    case KEY_F2 = 'F2';
    case KEY_F3 = 'F3';
    case KEY_F4 = 'F4';
    case KEY_F5 = 'F5';
    case KEY_F6 = 'F6';
    case KEY_F7 = 'F7';
    case KEY_F8 = 'F8';
    case KEY_F9 = 'F9';
    case KEY_F10 = 'F10';
    case KEY_F11 = 'F11';
    case KEY_F12 = 'F12';
    case KEY_A = 'A';
    case KEY_B = 'B';
    case KEY_C = 'C';
    case KEY_D = 'D';
    case KEY_E = 'E';
    case KEY_F = 'F';
    case KEY_G = 'G';
    case KEY_H = 'H';
    case KEY_I = 'I';
    case KEY_J = 'J';
    case KEY_K = 'K';
    case KEY_L = 'L';
    case KEY_M = 'M';
    case KEY_N = 'N';
    case KEY_O = 'O';
    case KEY_P = 'P';
    case KEY_Q = 'Q';
    case KEY_R = 'R';
    case KEY_S = 'S';
    case KEY_T = 'T';
    case KEY_U = 'U';
    case KEY_V = 'V';
    case KEY_W = 'W';
    case KEY_X = 'X';
    case KEY_Y = 'Y';
    case KEY_Z = 'Z';
    case KEY_0 = '0';
    case KEY_1 = '1';
    case KEY_2 = '2';
    case KEY_3 = '3';
    case KEY_4 = '4';
    case KEY_5 = '5';
    case KEY_6 = '6';
    case KEY_7 = '7';
    case KEY_8 = '8';
    case KEY_9 = '9';
}
