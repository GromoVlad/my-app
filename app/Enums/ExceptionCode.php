<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * @method static INVARIANT_VIOLATION
 * @method static NOT_FOUND
 * @method static ALREADY_EXISTS
 * @method static BAD_REQUEST
 */
class ExceptionCode extends BaseEnum
{
    const INVARIANT_VIOLATION = 1000;
    const NOT_FOUND = 1001;
    const ALREADY_EXISTS = 1002;
    const BAD_REQUEST = 1003;
}
