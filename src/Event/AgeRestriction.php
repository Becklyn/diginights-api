<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use C201\Support\Enum\Enum;

class AgeRestriction extends Enum
{
    const NONE = 0;
    const FROM_6 = 6;
    const FROM_12 = 12;
    const FROM_13 = 13;
    const FROM_14 = 14;
    const FROM_15 = 15;
    const FROM_16 = 16;
    const FROM_18 = 18;
    const FROM_21 = 21;
    const FROM_25 = 25;
    const FROM_30 = 30;
}
