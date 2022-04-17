<?php

declare(strict_types=1);

namespace App\Enums;

class CurrencyCode extends BaseEnum
{
    /** Рубль */
    const RUB = 'RUB';
    /** В Мосбирже используется именно такой код для рубля, по факту это "советский рубль" и он не равен текущему RUB */
    const SUR = 'SUR';
    /** Доллар */
    const USD = 'USD';
    /** Евро */
    const EUR = 'EUR';
}
