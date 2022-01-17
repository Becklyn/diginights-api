<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use C201\Support\Enum\Enum;

class AgeRestriction extends Enum
{
    public const NONE = 0;
    public const FROM_6 = 6;
    public const FROM_12 = 12;
    public const FROM_13 = 13;
    public const FROM_14 = 14;
    public const FROM_15 = 15;
    public const FROM_16 = 16;
    public const FROM_18 = 18;
    public const FROM_21 = 21;
    public const FROM_25 = 25;
    public const FROM_30 = 30;
}
