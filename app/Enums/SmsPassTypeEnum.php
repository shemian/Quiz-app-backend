<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PLAIN()
 * @method static static BM5()
 */

final class SmsPassTypeEnum extends Enum
{
    public const PLAIN = 0;
    public const BM5 = 1;

}
