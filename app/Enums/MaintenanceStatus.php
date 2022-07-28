<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MaintenanceStatus extends Enum
{
    const Inprogress =   0;
    const Pending =   1;
    const Completed = 2;
}
