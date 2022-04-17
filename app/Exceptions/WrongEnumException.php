<?php

declare(strict_types=1);

use JetBrains\PhpStorm\Pure;

class WrongEnumException extends Exception
{
    #[Pure]
    public function __construct(string $enumName, $wrongValue, Throwable $previous = null)
    {
        parent::__construct(sprintf('Неверное значение для %s: "%s"', $enumName, $wrongValue), 500, $previous);
    }
}
