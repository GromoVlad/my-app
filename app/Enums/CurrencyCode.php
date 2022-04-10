<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * @method static RUB
 * @method static USD
 * @method static EUR
 */
class CurrencyCode extends BaseEnum
{
    /** Рубль */
    const RUB = 'RUB';
    /** Доллар */
    const USD = 'USD';
    /** Евро */
    const EUR = 'EUR';
}
