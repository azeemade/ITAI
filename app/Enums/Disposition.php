<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Disposition extends Enum
{
    const Issued =   0;
    const Store =   1;
    const Lend = 2;
    const Disposed = 3;
}
