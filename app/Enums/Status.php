<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum
{
    const Issued =   0;
    const Store =   1;
    const Faulty = 2;
    const With_repairs = 3;
}
