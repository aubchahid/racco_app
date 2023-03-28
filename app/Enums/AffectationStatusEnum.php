<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self INPROGRESS()
 * @method static self PLANNED()
 * @method static self BLOCKED()
 * @method static self DONE()
 */
class AffectationStatusEnum extends Enum
{
     public const INPROGRESS = 'En cours';
     public const PLANNED = 'Planifié';
     public const BLOCKED = 'Bloqué';
     public const DONE = 'Terminé';
}
