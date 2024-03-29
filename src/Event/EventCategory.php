<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use Becklyn\Utilities\Enum\Enum;

class EventCategory extends Enum
{
    public const PARTY = 'Party';
    public const FESTIVAL = 'Festival';
    public const BUSTRIP = 'Bustrip';
    public const KONZERT = 'Konzert';
    public const MESSE = 'Messe';
    public const FILM = 'Film';
    public const SPORT = 'Sport';
    public const FITNESS = 'Fitness';
    public const COMEDY = 'Comedy';
    public const KUNST = 'Kunst';
    public const WORKSHOP = 'Workshop';
    public const VORTRAG = 'Vortrag';
    public const KULINARIK = 'Kulinarik';
    public const OKTOBERFEST = 'Oktoberfest';
    public const FRUEHLINGSWIESEN = 'Frühlingswiesen';
    public const FASCHING = 'Fasching';
    public const KARNEVAL = 'Karneval';
    public const HALLOWEEN = 'Halloween';
    public const KABARETT = 'Kabarett';
    public const THEATER = 'Theater';
    public const SONSTIGES = 'Sonstiges';
}
