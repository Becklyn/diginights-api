<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use C201\Support\Enum\Enum;

class AgeRestriction extends Enum
{
    const KEINE = 0;
    const AB_6 = 6;
    const AB_12 = 12;
    const AB_13 = 13;
    const AB_14 = 14;
    const AB_15 = 15;
    const AB_16 = 16;
    const AB_18 = 18;
    const AB_21 = 21;
    const AB_25 = 25;
    const AB_30 = 30;
}
