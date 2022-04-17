<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Доступные условия применения фильтров
 */
class FilterCondition extends BaseEnum
{
    /** Равно */
    const EQUAL = '=';
    /** Не равно */
    const NOT_EQUAL = '!=';
    /** Больше */
    const GREATER = '>';
    /** Больше или равно */
    const GREATER_OR_EQUAL = '>=';
    /** Меньше */
    const LESS = '<';
    /** Меньше или равно */
    const LESS_OR_EQUAL = '<=';
}
