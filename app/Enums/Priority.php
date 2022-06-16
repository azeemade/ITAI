<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Priority extends Enum
{
    const Critical =   0;
    const Important =   1;
    const Normal = 2;
    const Low = 3;
}
