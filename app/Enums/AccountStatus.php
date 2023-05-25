<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static INACTIVE()
 * @method static static ACTIVE()
 * @method static static SUSPENDED()
 */
final class AccountStatus extends Enum
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;
    public const SUSPENDED = 2;
}
